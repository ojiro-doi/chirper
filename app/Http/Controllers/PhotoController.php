<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('photos.index',[
            'photos'=>Photo::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated=$request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $path=$request->file('image')->store('upload','public');
        $validated['image_path'] = $path;

        $request->user()->photos()->create($validated);

        return redirect(route('photos.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo):RedirectResponse
    {
        Gate::authorize('delete',$photo);

        // ストレージから削除
        if(Storage::disk('public')->exists($photo->image_path)){
            Storage::disk('public')->delete($photo->image_path);
        }

        // モデルから削除
        $photo->delete();

        return redirect(route('photos.index'));
    }
}
