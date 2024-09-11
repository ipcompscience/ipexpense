@extends('layouts.app')

@section('title', 'Edit Income')

@section('content')
<div class="container">
    <h1>Edit Income</h1>
    <form action="{{ route('incomes.update', $income) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $income->amount }}" required>
        </div>
        <div class="form-group">
            <label for="source">Source</label>
            <input type="text" name="source" class="form-control" value="{{ $income->source }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $income->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $income->date }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Income</button>
    </form>
</div>
@endsection
