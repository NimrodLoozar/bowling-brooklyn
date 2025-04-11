<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateColumnToScoresTable extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            if (!Schema::hasColumn('scores', 'date')) {
                $table->date('date')->nullable()->after('score'); // Add the date column
            }
        });
    }

    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('date'); // Rollback the date column
        });
    }
}
