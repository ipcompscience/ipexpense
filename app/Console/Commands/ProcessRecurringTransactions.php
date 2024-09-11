<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RecurringTransaction;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;

class ProcessRecurringTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:process-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process recurring transactions and add expenses or incomes as scheduled';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        
        // Fetch all recurring transactions that need to be processed
        $recurringTransactions = RecurringTransaction::where('start_date', '<=', $today)->get();

        foreach ($recurringTransactions as $transaction) {
            // Determine the next due date for the recurring transaction
            $nextDueDate = $this->getNextDueDate($transaction);

            if ($nextDueDate && $nextDueDate->isSameDay($today)) {
                // Create a new expense or income
                if ($transaction->type === 'expense') {
                    Expense::create([
                        'user_id' => $transaction->user_id,
                        'category_id' => $transaction->category_id,
                        'amount' => $transaction->amount,
                        'description' => $transaction->description,
                        'date' => $today,
                    ]);
                } elseif ($transaction->type === 'income') {
                    Income::create([
                        'user_id' => $transaction->user_id,
                        'category_id' => $transaction->category_id,
                        'amount' => $transaction->amount,
                        'description' => $transaction->description,
                        'date' => $today,
                    ]);
                }
            }
        }

        return 0;
    }

    /**
     * Calculate the next due date for the recurring transaction.
     *
     * @param  RecurringTransaction  $transaction
     * @return Carbon|null
     */
    private function getNextDueDate(RecurringTransaction $transaction)
    {
        $startDate = Carbon::parse($transaction->start_date);
        $today = Carbon::today();

        switch ($transaction->frequency) {
            case 'daily':
                return $startDate->copy()->addDays($today->diffInDays($startDate) % 1);
            case 'weekly':
                return $startDate->copy()->addWeeks($today->diffInWeeks($startDate) % 1);
            case 'monthly':
                return $startDate->copy()->addMonths($today->diffInMonths($startDate) % 1);
            case 'yearly':
                return $startDate->copy()->addYears($today->diffInYears($startDate) % 1);
            default:
                return null;
        }
    }
}
