<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateUnitPricingNamesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("unit_pricing_names", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('unit_name')->nullable();
						$table->string('pricing_kind_name')->nullable();
						$table->timestamps();



						// ----------------------------------------------------
						// -- SELECT [unit_pricing_names]--
						// ----------------------------------------------------
						// $query = DB::table("unit_pricing_names")
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
                    Schema::dropIfExists("unit_pricing_names");
                }
            }
        