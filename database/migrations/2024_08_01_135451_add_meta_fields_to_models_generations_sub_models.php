<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaFieldsToModelsGenerationsSubModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('evtype');
            $table->string('meta_keyword')->nullable()->after('meta_title');
            $table->text('meta_description')->nullable()->after('meta_keyword');
        });

        Schema::table('generations', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('feature');
            $table->string('meta_keyword')->nullable()->after('meta_title');
            $table->text('meta_description')->nullable()->after('meta_keyword');
        });

        Schema::table('sub_models', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('feature');
            $table->string('meta_keyword')->nullable()->after('meta_title');
            $table->text('meta_description')->nullable()->after('meta_keyword');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keyword']);
        });

        Schema::table('generations', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keyword']);
        });

        Schema::table('sub_models', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keyword']);
        });
    }
}
