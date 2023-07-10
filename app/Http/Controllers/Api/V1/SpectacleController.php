<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Spectacle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\V1\SpectacleFilter;
use App\Http\Requests\StoreSpectacleRequest;
use App\Http\Requests\UpdateSpectacleRequest;

use App\Http\Resources\V1\SpectacleResource;
use App\Http\Resources\V1\SpectacleCollection;

class SpectacleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new SpectacleFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new SpectacleCollection(Spectacle::paginate());
        } else {
            $spectacles = Spectacle::orderByDesc('created_at')->where($queryItems)->paginate();
            return new SpectacleCollection($spectacles->appends($request->query()));
        }
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
    public function store(StoreSpectacleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Spectacle $spectacle)
    {
        return new SpectacleResource($spectacle);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spectacle $spectacle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpectacleRequest $request, Spectacle $spectacle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spectacle $spectacle)
    {
        //
    }
}
