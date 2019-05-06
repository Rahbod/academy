<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTranslateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translate_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->string('title');
            $table->string('source_language');
            $table->string('translation_language');
            $table->integer('price')->nullable();
            $table->string('translated_file')->nullable();
            $table->string('description')->nullable();
            $table->enum('status', ['PENDING','REJECTED','AWAITING_PAYMENT','PAID','TRANSLATED'])->default('PENDING');
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
        Schema::table('translate_requests', function (Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('translate_requests');
    }
}