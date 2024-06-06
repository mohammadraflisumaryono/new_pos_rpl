@extends('template.app')

<style>
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .product-container {
            display: flex;
            gap: 20px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .product-image {
            flex: 1;
            max-width: 350px;
        }
        .product-image img {
            width: 100%;
            border-radius: 5px;
        }
        .product-details {
            flex: 2;
        }
        .product-title {
            font-size: 24px;
            font-weight: bold;
        }
        .price {
            color: red;
            font-size: 24px;
            margin: 20px 0;
        }
        .description {
            margin-top: 20px;
        }
        .description ul {
            list-style: disc;
            padding-left: 20px;
            padding-right: 60px;
            text-align: justify;
            margin: 0;
        }
        .cart-section {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }
        .cart-section label {
            margin-right: 10px;
        }
        .cart-section input[type="number"] {
            width: 50px;
            text-align: center;
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .cart-section button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .delivery {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .delivery ul {
            list-style: none;
            padding: 0;
        }
        .delivery ul li {
            margin-bottom: 10px;
        }
        .delivery p {
            margin: 10px 0;
        }
        .delivery button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            text-align: center;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
        .card {
            --bs-card-inner-border-radius: none;
            --bs-card-bg: transparent;
            background-color: transparent;
            border: none;
        }
    </style>

@section('page_content')
<div class="card">
<div class="container">
    <div class="product-container">
        <div class="product-image">
            @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->nama }}">
            @else
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $product->nama }}">
            @endif
        </div>
        <div class="product-details">
            <div class="product-title">{{ $product->nama }}</div>
            <div class="price">Rp{{ number_format($product->harga, 2) }}</div>

            <div class="description">
                <ul>
                    <li><strong>Barcode:</strong> {{ $product->barcode }}</li>
                    <li><strong>Netto:</strong> {{ $product->netto }} kg</li>
                    <li><strong>Dimensi:</strong> {{ $product->dimensi }}</li>
                    <li><strong>Deskripsi:</strong> {{ $product->deskripsi }}</li>
                </ul>
            </div>

            <div class="cart-section">
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <label for="quantity">Jumlah Pembelian</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1">
                        <button type="submit">+ Keranjang</button>
                    </form>
                </div>

            <div class="delivery">
                <p>Pengiriman</p>
                <ul>
                    <li>Dikirim oleh SAPA Instant Delivery</li>
                    <li>Biaya Pengiriman Gratis</li>
                </ul>
                <p>Promo lebih banyak dengan belanja di aplikasi SunnyMart. Scan QR untuk download.</p>
                <button type="button">Lihat QR</button>
            </div>

            <a href="{{ route('products.index') }}" class="btn-primary">Back to Products</a>
        </div>
    </div>
</div>

</div>
@endsection