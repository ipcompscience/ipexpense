@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4">Budgets</h1>
        <a href="{{ route('budgets.create') }}" class="btn btn-outline-primary shadow-sm px-3 py-2">
            <i class="fas fa-plus-circle"></i> Add Budget
        </a>
    </div>

    @if($budgets->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No budgets available. Click "Add Budget" to create one.
        </div>
    @else
        <table class="table table-hover shadow-sm rounded">
            <thead class="thead-light">
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budgets as $budget)
                    <tr>
                        <td>{{ $budget->category->name }}</td>
                        <td>${{ number_format($budget->amount, 2) }}</td>
                        <td>{{ $budget->start_date->format('Y-m-d') }}</td>
                        <td>{{ $budget->end_date->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('budgets.edit', $budget) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('budgets.destroy', $budget) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this budget?');">
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
