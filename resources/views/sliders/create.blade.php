@extends('template.app')

@section('page_content')
<h1>Create Slider</h1>
<form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" name="image" required>
    </div>
    <div class="form-group">
        <label for="link">Link:</label>
        <input type="text" class="form-control" name="link" required>
    </div>
    <div class="form-group">
        <label for="button_text">Button Text:</label>
        <input type="text" class="form-control" name="button_text">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection