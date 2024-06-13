@extends('template.app')

@section('page_content')
<div class="container">
    <h1>View Discount Product</h1>
    <div class="mb-3">
        <label class="form-label">Product</label>
        <p>{{ $discount->product->nama }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Image URL</label>
        <p>{{ $discount->image_url }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">URL</label>
        <p>{{ $discount->url }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Discount Percentage</label>
        <p>{{ $discount->discount_percentage }}%</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Start Date</label>
        <p>{{ $discount->start_date }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">End Date</label>
        <p>{{ $discount->end_date }}</p>
    </div>
    <a href="{{ route('discount.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection