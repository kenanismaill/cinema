<?php

namespace App\Jobs;

use App\Models\Chair;
use App\Models\Film;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateChairForFilmJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $film;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Film $film)
    {
        $this->film = $film;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i = 1; $i <= $this->film->size; $i++) {
            Chair::query()->create([
                'film_id' => $this->film->id,
                'chair_number' => $i,
            ]);
        }
    }
}
