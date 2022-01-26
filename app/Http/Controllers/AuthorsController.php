<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreauthorsRequest;
use App\Http\Requests\UpdateauthorsRequest;
use App\Models\authors;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreauthorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreauthorsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function show(authors $authors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function edit(authors $authors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateauthorsRequest  $request
     * @param  \App\Models\authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateauthorsRequest $request, authors $authors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function destroy(authors $authors)
    {
        //
    }
}
