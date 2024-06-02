@extends('template.app')

@section('page_content')
<h1>Edit Slider</h1>
<form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" name="image">
        <img src="{{ asset('storage/' . $slider->image_path) }}" width="100" class="mt-2">
    </div>
    <div class="form-group">
        <label for="link">Link:</label>
        <input type="text" class="form-control" name="link" value="{{ $slider->link }}" required>
    </div>
    <div class="form-group">
        <label for="button_text">Button Text:</label>
        <input type="text" class="form-control" name="button_text" value="{{ $slider->button_text }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection