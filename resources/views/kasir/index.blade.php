@extends('template.app')

@section('styles')
<style>
    .pink {
        background-color: #F9DAD6;
    }
</style>
@endsection

@section('page_content')

<!-- Example Blade Template -->
<div class="container">
    <h1>Dashboard Kasir</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #A0DEFF;">
                    <h5 class="card-title">Transaksi Pending</h5>
                    <p class="card-text">{{ $totalPendingTransactions }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #91DDCF;">
                    <h5 class="card-title">Transaksi Sedang Dikirim</h5>
                    <p class="card-text">{{ $totalOnDeliveryTransactions }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <div class="card ">
                <div class="card-body pink">
                    <h5 class="card-title">Produk Hampir Habis</h5>
                    @if($productHampirHabis)

                    @foreach($productHampirHabis as $product)
                    <p class="card-text">{{ $product->nama }} - Stok: {{ $product->stock }}</p>
                    @endforeach

                    @else
                    <p class="card-text">Tidak ada produk yang hampir habis.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- More cards for other statistics -->
    </div>
</div>

@endsection