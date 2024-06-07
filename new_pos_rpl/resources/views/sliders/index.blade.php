@extends('template.app')

@section('page_content')
<a href="{{ route('sliders.create') }}" class="btn btn-primary mb-3" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33; font-weight: bold;">Add New Slider</a>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Link</th>
            <th>Button Text</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sliders as $slider)
        <tr>
            <td>{{ $slider->id }}</td>
            <td><img src="{{ asset('storage/' . $slider->image_path) }}" width="100"></td>
            <td>{{ $slider->link }}</td>
            <td>{{ $slider->button_text }}</td>
            <td>
                <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-primary btn-sm edit-btn" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33">Edit</a>
                <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection