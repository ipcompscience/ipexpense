@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Expense</option>
                <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Income</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Category</button>
    </form>
</div>
@endsection
