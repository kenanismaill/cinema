<?php

namespace App\Http\Controllers\Api\v1\Cinema;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Cinema\StoreCinemaRequest;
use App\Http\Resources\Api\v1\Cinema\CinemaResource;
use App\Jobs\CreateChairForCinemaJob;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CinemaController extends Controller
{

    public function index(Request $request)
    {
        $cinemas = Cinema::with('films')
            ->paginate($request->has('per_page') ? $request->get('per_page') : 20);

        return CinemaResource::collection($cinemas);
    }


    public function store(StoreCinemaRequest $request)
    {
        $data = $request->only(['name', 'description', 'city_id', 'films']);

        DB::beginTransaction();
        try {
            $cinema = Cinema::create($data);
            $cinema->films()->sync($data['films']);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return response()->noContent();
    }


    public function show(Cinema $cinema)
    {
        return CinemaResource::make($cinema->load('films', 'films.images'));
    }


    public function update(Request $request, Cinema $cinema)
    {
        abort(404);
    }


    public function destroy(Cinema $cinema)
    {
        abort(404);
    }
}
