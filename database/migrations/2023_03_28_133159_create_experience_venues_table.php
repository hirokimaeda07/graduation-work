<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateExperienceVenuesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("experience_venues", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('prefecture_name',20)->nullable();
						$table->string('municipalitie_name',20)->nullable();
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [experience_venues]--
						// ----------------------------------------------------
						// $query = DB::table("experience_venues")
						// ->get();
						// dd($query); //For checking



                    });
                }
    
                /**
                 * Reverse the migrations.
                 *
                 * @return void
                 */
                public function down()
                {
                    Schema::dropIfExists("experience_venues");
                }
            }
        