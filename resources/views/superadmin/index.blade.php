<!-- resources/views/superadmin/index.blade.php -->
@extends('template.app')


@section('styles')
<style>
    #userChart,
    #transactionChart,
    #revenueChart {
        max-width: 800px;
        margin: 0 auto;
        margin-bottom: 20px;
    }
</style>

@endsection

@section('page_content')
<div class="print-button">
        <button onclick="printPageContent()" class="btn btn-primary">Print Page</button>
    </div>

<div class="container mt-4">
    <div id="transactionChart"></div>
    <div id="userChart"></div>
    <div id="revenueChart"></div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var userChartOptions = {
            chart: {
                type: 'area',
                height: 400 // Atur tinggi chart
            },
            title: {
                text: 'Jumlah Pengguna Baru Tiap Bulan',
                align: 'center'
            },
            series: [{
                name: 'Users',
                data: @json(array_values($userCounts))
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }
        };

        var transactionChartOptions = {
            chart: {
                type: 'bar',
                height: 400 // Atur tinggi chart
            },
            title: {
                text: 'Jumlah Transaksi Tiap Bulan',
                align: 'center'
            },
            series: [{
                name: 'Transactions',
                data: @json(array_values($transactionCounts))
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }
        };

        var revenueChartOptions = {
            chart: {
                type: 'line',
                height: 400 // Atur tinggi chart
            },
            title: {
                text: 'Jumlah Uang Masuk Tiap Bulan',
                align: 'center'
            },
            series: [{
                name: 'Revenue',
                data: @json(array_values($monthlyRevenue))
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }
        };

        var userChart = new ApexCharts(document.querySelector("#userChart"), userChartOptions);
        var transactionChart = new ApexCharts(document.querySelector("#transactionChart"), transactionChartOptions);
        var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueChartOptions);

        userChart.render();
        transactionChart.render();
        revenueChart.render();
    });
    function printPageContent() {
        window.print();
    }
</script>

@endsection