<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->notNull();
            $table->string('icon')->nullable();
            $table->string('url')->notNull()->default('#');
            $table->bigInteger('menu_parent')->unsigned()->nullable();
            $table->string('menu_roles')->notNull()->default('all');
            $table->enum('is_aktif', ['y', 'n'])->notNull()->default('y');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary('id');

            $table->index('menu_parent');

            $table->foreign('menu_parent')
                ->references('id')
                ->on('menus')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('menus');
    }
};
