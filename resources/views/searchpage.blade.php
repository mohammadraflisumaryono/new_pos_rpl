@extends('template.app')

@section('page_content')


<section class="products">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-3">
                <hr>
            </div>
            @foreach($products as $product)
            <div class="col-4 col-md-4 col-lg-2 mb-4">
                <div class="card card-custom h-100">
                    <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="Image of {{ $product->nama }}">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title font-semibold title-clamp">{{$product->nama}}</h6>
                        <div class="price-and-button mt-auto">
                            <p class="card-text text-right">
                                @if($product->discounted_price && $product->discounted_price < $product->harga)
                                    <span class="discounted-price" style="color:red">Rp. {{ number_format($product->discounted_price) }}</span>
                                    <del>Rp. {{ number_format($product->harga) }}</del>
                                    @else
                                    Rp. {{ number_format($product->harga) }}
                                    @endif
                            </p>
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('cart.store') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-danger" style="background-color: #F9DAD6; border-color: #F9DAD6; color: #562D33">Beli</button>
                                </form>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-danger" style="background-color: #F9DAD6; border-color: #F9DAD6; color: #562D33">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection