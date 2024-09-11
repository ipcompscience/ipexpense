@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Recurring Transaction</h1>
    <form action="{{ route('recurring-transactions.update', $recurringTransaction) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="expense" {{ $recurringTransaction->type == 'expense' ? 'selected' : '' }}>Expense</option>
                <option value="income" {{ $recurringTransaction->type == 'income' ? 'selected' : '' }}>Income</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $recurringTransaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $recurringTransaction->amount }}" required>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $recurringTransaction->start_date->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="frequency">Frequency</label>
            <select name="frequency" class="form-control" required>
                <option value="daily" {{ $recurringTransaction->frequency == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ $recurringTransaction->frequency == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ $recurringTransaction->frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="yearly" {{ $recurringTransaction->frequency == 'yearly' ? 'selected' : '' }}>Yearly</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $recurringTransaction->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Recurring Transaction</button>
    </form>
</div>
@endsection
