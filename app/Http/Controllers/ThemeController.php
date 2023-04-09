<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::findOrFail(1);
        return view('admin.pages.themes.index', [
            'theme' => $themes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $theme = Theme::findOrFail(1);

        if ($request->hasFile('logo')) {
            $img = $request->file('logo');
            $logo = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/logo/') . $logo);
            if ($theme->logo==='logo.png') {

            } else {
                unlink('storage/logo/' . $request->old_logo);
            }

        } else {
            $logo = $request->old_logo;
        }
        if ($request->hasFile('favicon')) {
            $img = $request->file('favicon');
            $favicon = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/logo/') . $favicon);
            if ($theme->favicon==='favicon.png') {

            } else {
                unlink('storage/logo/' . $request->old_favicon);
            }
        } else {
            $favicon = $request->old_favicon;
        }

        $social = [
            'facebook' => $request->facebook ?? '',
            'twitter' => $request->twitter ?? '',
            'linkedin' => $request->linkedin ?? '',
            'instagram' => $request->instagram ?? '',
            'youtube' => $request->youtube ?? '',
        ];

        $theme->update([
            'title' => $request->title,
            'tagline' => $request->tagline,
            'favicon' => $favicon,
            'logo' => $logo,
            'social' => json_encode($social),
            'copyright' => $request->copyright,
        ]);
        return back()->with('success', 'Theme Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
