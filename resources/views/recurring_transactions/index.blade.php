@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4">Recurring Transactions</h1>
        <div class="d-flex align-items-center">
            <!-- Toggle Link for Switching Views -->
            <a href="#" id="toggleView" class="text-secondary me-3" style="text-decoration: none;">
                <i class="fas fa-th-large"></i> Switch to List View
            </a>
            <!-- Add Recurring Transaction Button with spacing -->            
            <a href="{{ route('recurring-transactions.create') }}" class="btn btn-outline-primary shadow-sm px-3 py-2" style="margin-left: 10px;">

                <i class="fas fa-plus-circle"></i> Add Recurring Transaction
            </a>
        </div>
    </div>

    @if($recurringTransactions->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No recurring transactions available. Click "Add Recurring Transaction" to create one.
        </div>
    @else
        <!-- Card View -->
        <div id="cardView" class="row">
            @foreach ($recurringTransactions as $transaction)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title mb-1">{{ ucfirst($transaction->type) }}</h5>
                                <p class="text-muted mb-2">{{ $transaction->category->name }}</p>
                                <p class="font-weight-bold text-success mb-3">${{ number_format($transaction->amount, 2) }}</p>
                                <p class="text-muted">{{ ucfirst($transaction->frequency) }} starting on {{ $transaction->start_date->format('Y-m-d') }}</p>
                                <p class="text-muted">{{ $transaction->description }}</p>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('recurring-transactions.edit', $transaction) }}" class="btn btn-sm btn-outline-warning me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('recurring-transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this transaction?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- List View -->
        <div id="listView" class="d-none">
            <table class="table table-hover shadow-sm rounded">
                <thead class="thead-light">
                    <tr>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Start Date</th>
                        <th>Frequency</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recurringTransactions as $transaction)
                        <tr>
                            <td>{{ ucfirst($transaction->type) }}</td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>${{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->start_date->format('Y-m-d') }}</td>
                            <td>{{ ucfirst($transaction->frequency) }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>
                                <a href="{{ route('recurring-transactions.edit', $transaction) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('recurring-transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this transaction?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleViewLink = document.getElementById('toggleView');
        const cardView = document.getElementById('cardView');
        const listView = document.getElementById('listView');

        toggleViewLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            if (cardView.classList.contains('d-none')) {
                // Switch to Card View
                cardView.classList.remove('d-none');
                listView.classList.add('d-none');
                toggleViewLink.innerHTML = '<i class="fas fa-th-list"></i> Switch to List View';
            } else {
                // Switch to List View
                cardView.classList.add('d-none');
                listView.classList.remove('d-none');
                toggleViewLink.innerHTML = '<i class="fas fa-th-large"></i> Switch to Card View';
            }
        });
    });
</script>
@endsection
