<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Billet;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBilletRequest;
use App\Http\Resources\V1\BilletResource;
use App\Http\Requests\UpdateBilletRequest;
use App\Http\Resources\V1\BilletCollection;

class BilletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BilletCollection(Billet::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBilletRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Billet $billet)
    {
        return new BilletResource($billet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billet $billet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBilletRequest $request, Billet $billet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billet $billet)
    {
        //
    }
}
