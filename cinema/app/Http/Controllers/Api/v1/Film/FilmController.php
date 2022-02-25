<?php

namespace App\Http\Controllers\Api\v1\Film;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Film\StoreFilmRequest;
use App\Http\Resources\Api\v1\Film\FilmResource;
use App\Jobs\CreateChairForFilmJob;
use App\Models\Chair;
use App\Models\Film;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{

    public function index(Request $request)
    {
        $films = Film::query()->with('empty_chairs','cinema')
            ->orderByDesc('id')
            ->paginate($request->has('per_page') ? $request->get('per-page') : 20);
        return FilmResource::collection($films);
    }

    public function store(StoreFilmRequest $request)
    {
        $data = $request->only(['name', 'description', 'start_date', 'end_date', 'type', 'size']);
        $imageName = null;
        DB::beginTransaction();
        try {
            $film = Film::create($data);
            CreateChairForFilmJob::dispatch($film);

            if ($request->has('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                Storage::disk('local')->put('images\\' . $imageName, file_get_contents($image));

                $film->images()->create([
                    'name' => $imageName,
                    'url' => storage_path('app\\images\\' . $imageName),
                ]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('error has been accrued while saving the film by user ' . auth()->user());
            throw $exception;
        }

        DB::commit();
        return response()->noContent();

    }

    public function show(Film $film)
    {
        return FilmResource::make($film->load('empty_chairs'));
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
