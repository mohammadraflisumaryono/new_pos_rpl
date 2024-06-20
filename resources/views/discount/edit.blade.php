@extends('template.app')

@section('page_content')
<div class="container">
    <h1>Edit Discount Product</h1>
    <form action="{{ route('discount.update', $discount->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Select Product</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $product->id == $discount->product_id ? 'selected' : '' }}>{{ $product->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" name="url" id="url" class="form-control" value="{{ $discount->url }}" required>
        </div>
        <div class="mb-3">
            <label for="discount_percentage" class="form-label">Discount Percentage</label>
            <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" step="0.01" value="{{ $discount->discount_percentage }}" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $discount->start_date }}" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $discount->end_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33">Update</button>
        <a href="{{ route('discount.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection