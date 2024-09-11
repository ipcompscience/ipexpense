@extends('layouts.app')

@section('title', 'Edit Expense')

@section('content')
<div class="container">
    <h1>Edit Expense</h1>
    <form action="{{ route('expenses.update', $expense) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $expense->amount }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" class="form-control" value="{{ $expense->category->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $expense->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $expense->date }}" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" class="form-control">
                <option value="cash" {{ $expense->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="credit_card" {{ $expense->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                <option value="bank_transfer" {{ $expense->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <!-- Add more payment methods as needed -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Expense</button>
    </form>
</div>
@endsection
