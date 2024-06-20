@extends('template.app')

@section('page_content')
<div class="container">
    <a href="{{ route('discount.create') }}" class="btn btn-primary mb-3" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33; font-weight: bold;">Add Discount Product</a>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Discount Percentage</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
            <tr>
                <td>{{ $discount->id }}</td>
                <td>{{ $discount->product->nama }}</td>
                <td>{{ $discount->discount_percentage }}%</td>
                <td>{{ $discount->start_date }}</td>
                <td>{{ $discount->end_date }}</td>
                <td>
                    <a href="{{ route('discount.edit', $discount->id) }}" class="btn btn-sm btn-danger" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33">Edit</a>
                    <form action="{{ route('discount.destroy', $discount->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection