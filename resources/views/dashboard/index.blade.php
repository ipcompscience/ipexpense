@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Expenses</div>
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($totalExpenses, 2) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Income</div>
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($totalIncome, 2) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Balance</div>
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($balance, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Expense Summary</h3>
            <canvas id="expenseChart"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Income Summary</h3>
            <canvas id="incomeChart"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Budget Overview</h3>
            <canvas id="budgetChart"></canvas>
        </div>
    </div>
</div>

<!-- Include the Chart.js library and the date adapter -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Combined chart for expenses and income
        var expenseCtx = document.getElementById('expenseChart').getContext('2d');
        var incomeCtx = document.getElementById('incomeChart').getContext('2d');
        var budgetCtx = document.getElementById('budgetChart').getContext('2d');

        var expenseChart = new Chart(expenseCtx, {
            type: 'line',
            data: {
                labels: @json($expenseData['labels']),
                datasets: [{
                    label: 'Expenses',
                    data: @json($expenseData['data']),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { 
                        type: 'time', 
                        time: { unit: 'day' } 
                    },
                    y: { beginAtZero: true }
                }
            }
        });

        var incomeChart = new Chart(incomeCtx, {
            type: 'line',
            data: {
                labels: @json($incomeData['labels']),
                datasets: [{
                    label: 'Income',
                    data: @json($incomeData['data']),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { 
                        type: 'time', 
                        time: { unit: 'day' } 
                    },
                    y: { beginAtZero: true }
                }
            }
        });

        // Create the budget chart with both budget amounts and expenses
        var budgetChart = new Chart(budgetCtx, {
            type: 'bar',
            data: {
                labels: @json($budgetData->pluck('label')),
                datasets: [
                    {
                        label: 'Budget',
                        data: @json($budgetData->pluck('amount')),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Expenses During Budget Period',
                        data: @json($budgetData->pluck('expenses')),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endsection
