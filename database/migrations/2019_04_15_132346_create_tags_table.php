<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('created_at');
            $table->integer('updated_at');
        });
        \Illuminate\Support\Facades\DB::table('tags')->insert([
            ['name'=>'apéritifs', 'created_at'=> time(), 'updated_at' => time()],
            ['name' => 'entrées', 'created_at'=> time(), 'updated_at' => time()],
            ['name' => 'plats', 'created_at'=> time(), 'updated_at' => time()],
            ['name' => 'pâtes', 'created_at'=> time(), 'updated_at' => time()],
            ['name' => 'desserts', 'created_at'=> time(), 'updated_at' => time()],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
