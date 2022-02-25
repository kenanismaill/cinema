<?php

use App\Models\Cinema;
use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinema_film', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Film::class)->constrained('films')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Cinema::class)->constrained('cinemas')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cinema_film');
    }
};
