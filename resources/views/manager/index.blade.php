@extends('template.app')

@section('styles')
<style>
    .card-header {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
    }

    #transactionsStatusChart,
    #monthlyRevenueChart,
    #deliveryTypeChart,
    #dailyRevenueChart {
        margin-bottom: 20px;
    }
</style>
@endsection

@section('page_content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    Jumlah Transaksi per Status
                </div>
                <div class="card-body">
                    <div id="transactionsStatusChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    Total Pendapatan per Bulan
                </div>
                <div class="card-body">
                    <div id="monthlyRevenueChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    Proporsi Jenis Pengiriman
                </div>
                <div class="card-body">
                    <div id="deliveryTypeChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    Total Pendapatan per Hari
                </div>
                <div class="card-body">
                    <div id="dailyRevenueChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Bar Chart: Jumlah Transaksi per Status
        var transactionsStatusData = @json($transactions_status->pluck('count'));
        var transactionsStatusLabels = @json($transactions_status->pluck('status'));

        var transactionsStatusOptions = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Jumlah Transaksi',
                data: transactionsStatusData
            }],
            xaxis: {
                categories: transactionsStatusLabels
            },
            yaxis: {
                title: {
                    text: 'Jumlah Transaksi'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " transaksi"
                    }
                }
            }
        };
        var transactionsStatusChart = new ApexCharts(document.querySelector("#transactionsStatusChart"), transactionsStatusOptions);
        transactionsStatusChart.render();

        // 2. Line Chart: Total Pendapatan per Bulan
        var monthlyRevenueData = @json($monthly_revenue->pluck('total'));
        var monthlyRevenueLabels = @json($monthly_revenue->pluck('month'));

        var monthlyRevenueOptions = {
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            stroke: {
                width: 7,
                curve: 'smooth'
            },
            series: [{
                name: 'Total Pendapatan',
                data: monthlyRevenueData
            }],
            xaxis: {
                categories: monthlyRevenueLabels
            },
            yaxis: {
                title: {
                    text: 'Total Pendapatan (Rp)'
                }
            },
            markers: {
                size: 5,
                hover: {
                    size: 7
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        };
        var monthlyRevenueChart = new ApexCharts(document.querySelector("#monthlyRevenueChart"), monthlyRevenueOptions);
        monthlyRevenueChart.render();

        // 3. Pie Chart: Proporsi Jenis Pengiriman
        var deliveryTypeData = @json($delivery_type->pluck('count'));
        var deliveryTypeLabels = @json($delivery_type->pluck('delivery_type')->map(function($type) {
            return str_replace('_', ' ', $type);
        }));

        var deliveryTypeOptions = {
            chart: {
                type: 'pie',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            labels: deliveryTypeLabels,
            series: deliveryTypeData,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " transaksi"
                    }
                }
            }
        };
        var deliveryTypeChart = new ApexCharts(document.querySelector("#deliveryTypeChart"), deliveryTypeOptions);
        deliveryTypeChart.render();

        // 4. Area Chart: Total Pendapatan per Hari
        var dailyRevenueData = @json($daily_revenue->pluck('total'));
        var dailyRevenueLabels = @json($daily_revenue->pluck('date'));

        var dailyRevenueOptions = {
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Total Pendapatan',
                data: dailyRevenueData
            }],
            xaxis: {
                categories: dailyRevenueLabels
            },
            yaxis: {
                title: {
                    text: 'Total Pendapatan (Rp)'
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        };
        var dailyRevenueChart = new ApexCharts(document.querySelector("#dailyRevenueChart"), dailyRevenueOptions);
        dailyRevenueChart.render();
    });
</script>
@endsection