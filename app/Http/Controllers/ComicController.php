<?php

namespace App\Http\Controllers;

use App\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Comic::pipe(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'required', 'max:140'],
            'description' => ['string', 'required'],
            'tags' => ['json', 'required'],
            'genres' => ['json', 'required'],
            'cover_url' => ['file', 'required'],
            'release_date' => ['date', 'required'],
            'is_draft' => ['boolean', 'required']
        ]);

        $validated['cover_url'] = $this->storeFileFromRequest($request, 'cover_url', 'public/media/covers');

        return response()->json(Comic::create($validated), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        $validated = $request->validate([
            'name' => ['string', 'max:140'],
            'description' => ['string'],
            'tags' => ['json'],
            'genres' => ['json'],
            'cover_url' => ['file'],
            'release_date' => ['date'],
            'is_draft' => ['boolean']
        ]);

        if(!empty($validated['cover_url'])){
            $validated['cover_url'] = $this->storeFileFromRequest($request, 'cover_url', 'public/media/covers');
        }

        return response()->json($comic->update($validated), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        return response()->json($comic->delete());
    }
}
