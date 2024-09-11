@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<div class="container">
    <h1>Add Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="expense">Expense</option>
                <option value="income">Income</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save Category</button>
    </form>
</div>
@endsection
