@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4">Your Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary shadow-sm px-3 py-2">
            <i class="fas fa-plus-circle"></i> Add Category
        </a>
    </div>

    @if($categories->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No categories available. Click "Add Category" to create one.
        </div>
    @else
        <table class="table table-hover shadow-sm rounded">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ ucfirst($category->type) }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
