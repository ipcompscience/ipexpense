<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $last30Days = $today->copy()->subDays(30);

        // Fetch expenses and incomes for the last 30 days
        $expenses = $user->expenses()
            ->where('date', '>=', $last30Days)
            ->orderBy('date', 'asc')
            ->get();

        $incomes = $user->incomes()
            ->where('date', '>=', $last30Days)
            ->orderBy('date', 'asc')
            ->get();

        // Prepare data for charts
        $expenseData = $this->prepareChartData($expenses, 'amount');
        $incomeData = $this->prepareChartData($incomes, 'amount');

        // Fetch budgets for the authenticated user
        $budgets = $user->budgets;
        $budgetData = $budgets->map(function ($budget) use ($user) {
            // Calculate total expenses within the budget date range
            $expensesWithinBudget = $user->expenses()
                ->where('category_id', $budget->category_id)
                ->whereBetween('date', [$budget->start_date, $budget->end_date])
                ->sum('amount');

            return [
                'label' => $budget->category->name,
                'amount' => $budget->amount,
                'expenses' => $expensesWithinBudget, // Include expenses within the budget
            ];
        });

        // Calculate summary totals
        $totalExpenses = $expenses->sum('amount');
        $totalIncome = $incomes->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        // Pass the data to the view
        return view('dashboard.index', compact('expenseData', 'incomeData', 'budgetData', 'totalExpenses', 'totalIncome', 'balance'));
    }

    private function prepareChartData($records, $field)
    {
        $data = [];
        $dates = [];

        // Generate a list of the last 30 days
        $today = Carbon::today();
        for ($i = 0; $i <= 30; $i++) {
            $date = $today->copy()->subDays($i)->format('Y-m-d');
            $dates[$date] = 0;
        }

        foreach ($records as $record) {
            $date = $record->date->format('Y-m-d'); // Ensure date is formatted correctly
            if (isset($dates[$date])) {
                $dates[$date] += $record->$field;
            }
        }

        // Prepare labels and data for Chart.js
        return [
            'labels' => array_keys($dates),
            'data' => array_values($dates),
        ];
    }
}
