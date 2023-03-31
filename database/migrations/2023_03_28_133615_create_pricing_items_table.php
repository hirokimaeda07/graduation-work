<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreatePricingItemsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("pricing_items", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('project_id')->unsigned();
						$table->bigInteger('unit_pricing_name_id')->nullable()->unsigned();
						$table->integer('experience_fee')->nullable();
						$table->integer('eligible_age_min')->nullable();
						$table->integer('eligible_age_max')->nullable();
						$table->string('experience_fee_note',250)->nullable();
						$table->bigInteger('acceptable_number_id')->nullable();
						$table->text('price_setting_note')->nullable();
						$table->text('discount_surcharge_price_note')->nullable();
						$table->timestamps();
						$table->foreign("project_id")->references("id")->on("projects");
						$table->foreign("unit_pricing_name_id")->references("id")->on("unit_pricing_names");



						// ----------------------------------------------------
						// -- SELECT [pricing_items]--
						// ----------------------------------------------------
						// $query = DB::table("pricing_items")
						// ->leftJoin("projects","projects.id", "=", "pricing_items.project_id")
						// ->leftJoin("unit_pricing_names","unit_pricing_names.id", "=", "pricing_items.unit_pricing_name_id")
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
                    Schema::dropIfExists("pricing_items");
                }
            }
        