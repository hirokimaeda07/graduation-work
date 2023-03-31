<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateAcceptableNumbersTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("acceptable_ numbers", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('project_id')->unsigned();
						$table->integer('mini_acceptance_number')->nullable();
						$table->integer('max_acceptance_number')->nullable();
						$table->bigInteger('unit_pricing_name_id')->nullable()->unsigned();
						$table->timestamps();
						$table->foreign("project_id")->references("id")->on("projects");
						$table->foreign("unit_pricing_name_id")->references("id")->on("unit_pricing_names");



						// ----------------------------------------------------
						// -- SELECT [acceptable_ numbers]--
						// ----------------------------------------------------
						// $query = DB::table("acceptable_ numbers")
						// ->leftJoin("projects","projects.id", "=", "acceptable_ numbers.project_id")
						// ->leftJoin("unit_pricing_names","unit_pricing_names.id", "=", "acceptable_ numbers.unit_pricing_name_id")
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
                    Schema::dropIfExists("acceptable_ numbers");
                }
            }
        