<?php

namespace App\Http\Controllers\Api\v1\BookingChair;

use App\Http\Controllers\Controller;
use App\Models\BookingChair;
use App\Models\Chair;
use App\Models\Film;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingChairController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request, Film $film, $chairNumber)
    {
        $chair = Chair::query()->where('chair_number', '=', $chairNumber)
            ->where('film_id', '=', $film->id)->firstOrFail();

        if ($chair->status == true)
            return response()->json([
                "message" => "please select available chair"
            ], 404);

        else {
            DB::beginTransaction();
            try {
                $data = [
                    'chair_id' => $chair->id,
                    'film_id' => $film->id,
                    'user_id' => $request->user_id ?? auth()->user()->id
                ];
                // booking a chair
                BookingChair::create($data);
                // create instance of ticket
                Ticket::create($data);
                //update chair status from empty to full
                $chair->update([
                    'status' => true
                ]);
            } catch (\Exception $exception) {
                DB::rollBack();
                throw $exception;
            }
            DB::commit();
        }

        return response()->noContent();
    }


    public function show($id)
    {
        //
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
