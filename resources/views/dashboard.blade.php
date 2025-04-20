@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <!-- Best Selling Article -->
<!-- Top 4 Best Selling Articles -->
<div class="card mb-3">
    <h5 class="card-header">Top 4 Best Selling Articles</h5>
    <div class="card-body">
        @if($topSellingArticles->isEmpty())
            <p>No sales data available for top-selling articles.</p>
        @else
            <div class="row">
                @foreach($topSellingArticles as $articleSale)
                    <div class="col-md-3 mb-3">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $articleSale->article->image) }}" class="card-img-top" alt="{{ $articleSale->article->nom }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $articleSale->article->nom }}</h5>
                                <p class="card-text">{{ $articleSale->article->description }}</p>
                                <p class="card-text">Prix: {{ $articleSale->article->prix_de_vente }} TND</p>
                                <p class="card-text">Total Sales: {{ $articleSale->total_sales }} units</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="row mb-3">
    <!-- Unavailable Articles Card -->
    <div class="col-md-6 mb-3">
        <div class="card h-100"> <!-- Ensure the card height is consistent -->
            <h5 class="card-header">Unavailable Articles</h5>
            <div class="card-body">
                @if($unavailableArticles->isEmpty())
                    <p>No unavailable articles.</p>
                @else
                    <div class="row">
                        @foreach ($unavailableArticles as $article)
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->nom }}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $article->nom }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Articles with Quantity < 10 Card -->
    <div class="col-md-6 mb-3">
        <div class="card h-100"> <!-- Ensure the card height is consistent -->
            <h5 class="card-header">Articles with Quantity < 10</h5>
            <div class="card-body">
                @if($articlesBelowTen->isEmpty())
                    <p>No articles with quantity less than 10.</p>
                @else
                    <div class="row">
                        @foreach ($articlesBelowTen as $article)
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->nom }}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $article->nom }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


    <!-- Profit per Month and Profit per Year -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Profit per Month</h5>
                <div class="card-body">
                    <canvas id="monthlyProfitChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Profit per Year</h5>
                <div class="card-body">
                    <canvas id="yearlyProfitChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles by Category and Articles by Supplier -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Articles by Category</h5>
                <div class="card-body">
                    <canvas id="categoryPieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Articles by Supplier</h5>
                <div class="card-body">
                    <canvas id="supplierPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Monthly Profit Chart
    var monthlyProfitCtx = document.getElementById('monthlyProfitChart').getContext('2d');
    var monthlyProfitChart = new Chart(monthlyProfitCtx, {
        type: 'bar',
        data: {
            labels: @json($monthlyProfit->pluck('month')),
            datasets: [{
                label: 'Profit',
                data: @json($monthlyProfit->pluck('total_profit')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });

    // Yearly Profit Chart
    var yearlyProfitCtx = document.getElementById('yearlyProfitChart').getContext('2d');
    var yearlyProfitChart = new Chart(yearlyProfitCtx, {
        type: 'bar',
        data: {
            labels: @json($yearlyProfit->pluck('year')),
            datasets: [{
                label: 'Profit',
                data: @json($yearlyProfit->pluck('total_profit')),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        }
    });

    // Articles by Category Pie Chart
    var categoryPieChartCtx = document.getElementById('categoryPieChart').getContext('2d');
    var categoryPieChart = new Chart(categoryPieChartCtx, {
        type: 'pie',
        data: {
            labels: @json($articlesByCategory->pluck('category_name')), // Change to category name
            datasets: [{
                data: @json($articlesByCategory->pluck('total')),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733'],
            }]
        }
    });

    // Articles by Supplier Pie Chart
    var supplierPieChartCtx = document.getElementById('supplierPieChart').getContext('2d');
    var supplierPieChart = new Chart(supplierPieChartCtx, {
        type: 'pie',
        data: {
            labels: @json($articlesBySupplier->pluck('supplier_name')), // Change to supplier name
            datasets: [{
                data: @json($articlesBySupplier->pluck('total')),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733'],
            }]
        }
    });
</script>

@endsection
