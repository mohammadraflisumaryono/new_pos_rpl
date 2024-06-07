<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $data['page_title'] = 'Slider Management';
        $data['sliders'] = $sliders;
        return view('sliders.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create Slider';
        return view('sliders.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|string',
            'button_text' => 'nullable|string',
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('images/sliders', 'public');

        Slider::create([
            'image_path' => $imagePath,
            'link' => $request->link,
            'button_text' => $request->button_text,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }



<<<<<<< Updated upstream
    public function edit(Slider $slider)
    {
        $data['page_title'] = 'Edit Slider';
        return view('sliders.edit', compact('slider', 'data'));
    }
=======
    public function edit($id){
        $page_title = 'Edit Slider';
        return view('sliders.edit', compact('slider', 'page_title'));
}
>>>>>>> Stashed changes

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|string',
            'button_text' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $slider->image_path);
            $image = $request->file('image');
            $imagePath = $image->store('images/sliders', 'public');
            $slider->image_path = $imagePath;
        }

        $slider->link = $request->link;
        $slider->button_text = $request->button_text;
        $slider->save();

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        Storage::delete('public/' . $slider->image_path);
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
