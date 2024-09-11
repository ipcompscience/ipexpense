@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Budget</h1>
    <form action="{{ route('budgets.update', $budget) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $budget->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $budget->amount }}" required>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $budget->start_date->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $budget->end_date->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Budget</button>
    </form>
</div>
@endsection
