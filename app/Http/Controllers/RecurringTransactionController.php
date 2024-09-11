<?php

namespace App\Http\Controllers;

use App\Models\RecurringTransaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecurringTransactionController extends Controller
{
    public function index()
    {
        $recurringTransactions = Auth::user()->recurringTransactions()->orderBy('start_date', 'asc')->get();
        return view('recurring_transactions.index', compact('recurringTransactions'));
    }

    public function create()
    {
        $categories = Auth::user()->categories;
        return view('recurring_transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:expense,income',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'frequency' => 'required|in:daily,weekly,monthly,yearly',
            'description' => 'nullable|string',
        ]);

        Auth::user()->recurringTransactions()->create($request->all());

        return redirect()->route('recurring-transactions.index')->with('success', 'Recurring transaction created successfully.');
    }

    public function edit(RecurringTransaction $recurringTransaction)
    {

        $categories = Auth::user()->categories;
        return view('recurring_transactions.edit', compact('recurringTransaction', 'categories'));
    }

    public function update(Request $request, RecurringTransaction $recurringTransaction)
    {

        $request->validate([
            'type' => 'required|in:expense,income',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'frequency' => 'required|in:daily,weekly,monthly,yearly',
            'description' => 'nullable|string',
        ]);

        $recurringTransaction->update($request->all());

        return redirect()->route('recurring-transactions.index')->with('success', 'Recurring transaction updated successfully.');
    }

    public function destroy(RecurringTransaction $recurringTransaction)
    {

        $recurringTransaction->delete();

        return redirect()->route('recurring-transactions.index')->with('success', 'Recurring transaction deleted successfully.');
    }
}
