<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreateProjectsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("projects", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->bigInteger('user_id')->unsigned();
						$table->bigInteger('company_id')->nullable()->unsigned();
						$table->bigInteger('posted_language_id')->nullable()->unsigned();
						$table->bigInteger('experience_venue_id')->nullable()->unsigned();
						$table->bigInteger('experience_category_id')->nullable()->unsigned();
						$table->string('plan_title',250)->nullable();
						$table->text('plan_body')->nullable();
						$table->text('plan_feature_title')->nullable();
						$table->text('plan_feature_detail')->nullable();
						$table->time('total_required_time')->nullable();
						$table->integer('total_days_required')->nullable();
						$table->integer('real_experience_time')->nullable();
						$table->integer('real_experience_day')->nullable();
						$table->integer('available_min_age')->nullable();
						$table->integer('available_max_age')->nullable();
						$table->integer('min_working_people')->nullable();
						$table->integer('max_working_people')->nullable();
						$table->integer('all_year_round')->nullable();
						$table->date('start_season_day')->nullable();
						$table->date('end_season_day')->nullable();
						$table->text('season_note')->nullable();
						$table->integer('reserv_deadline_day')->nullable();
						$table->time('reserv_deadline_time')->nullable();
						$table->integer('meeting_time')->nullable();
						$table->text('meeting_time_note')->nullable();
						$table->string('meet_place_address',250)->nullable();
						$table->text('meet_place_name')->nullable();
						$table->integer('pick_up_existence')->nullable();
						$table->text('pick_up_note')->nullable();
						$table->string('access_car_detai',250)->nullable();
						$table->string('access_train_detai',250)->nullable();
						$table->string('access_other_detai',250)->nullable();
						$table->integer('car_parking_existence')->nullable();
						$table->integer('number_car_parking')->nullable();
						$table->integer('bus_parking_existence')->nullable();
						$table->integer('number_bus_parking')->nullable();
						$table->text('parking_note')->nullable();
						$table->time('adjust_experience_start_time')->nullable();
						$table->time('adjust_experience_end_time')->nullable();
						$table->text('things_to_bring')->nullable();
						$table->text('free_rental_goods')->nullable();
						$table->text('paid_rental_goods')->nullable();
						$table->text('shop_equipment')->nullable();
						$table->text('participation_important_point')->nullable();
						$table->text('participation_note')->nullable();
						$table->text('price_include')->nullable();
						$table->text('not_included_price')->nullable();
						$table->timestamps();
						$table->softDeletes();
						$table->foreign("user_id")->references("id")->on("users");
						$table->foreign("company_id")->references("id")->on("companies");
						$table->foreign("posted_language_id")->references("id")->on("posted_languages");
						$table->foreign("experience_venue_id")->references("id")->on("experience_venues");
						$table->foreign("experience_category_id")->references("id")->on("experience_categories");



						// ----------------------------------------------------
						// -- SELECT [projects]--
						// ----------------------------------------------------
						// $query = DB::table("projects")
						// ->leftJoin("users","users.id", "=", "projects.user_id")
						// ->leftJoin("companies","companies.id", "=", "projects.company_id")
						// ->leftJoin("posted_languages","posted_languages.id", "=", "projects.posted_language_id")
						// ->leftJoin("experience_venues","experience_venues.id", "=", "projects.experience_venue_id")
						// ->leftJoin("experience_categories","experience_categories.id", "=", "projects.experience_category_id")
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
                    Schema::dropIfExists("projects");
                }
            }
        