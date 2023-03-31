<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateOptionSettingNamesTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("option_setting _names", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('project_id')->unsigned();
						$table->string('option_type_name',100)->nullable();
						$table->integer('option_fee')->nullable();
						$table->bigInteger('unit_pricing_name_id')->nullable()->unsigned();
						$table->string('option_fee_note',250)->nullable();
						$table->text('option_setting_note')->nullable();
						$table->timestamps();
						$table->foreign("project_id")->references("id")->on("projects");
						$table->foreign("unit_pricing_name_id")->references("id")->on("unit_pricing_names");



						// ----------------------------------------------------
						// -- SELECT [option_setting _names]--
						// ----------------------------------------------------
						// $query = DB::table("option_setting _names")
						// ->leftJoin("projects","projects.id", "=", "option_setting _names.project_id")
						// ->leftJoin("unit_pricing_names","unit_pricing_names.id", "=", "option_setting _names.unit_pricing_name_id")
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
                    Schema::dropIfExists("option_setting _names");
                }
            }
        