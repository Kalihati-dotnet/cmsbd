<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsbdsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_token', 60)->unique();
            $table->string('display_name')->nullable();
            $table->string('salt')->nullable();
            $table->string('activation_hash')->nullable();
            $table->boolean('is_activated')->default(0);
            $table->rememberToken();
            $table->string('joined_addr', 20)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    
        Schema::create('roles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->unique();
          $table->string('display_name')->nullable();
          $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('table_name')->nullable();
           // $table->string('description')->nullable();
            $table->timestamps();
        });
  
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            //$table->string('user_type')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'role_id']);
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');
            //$table->string('user_type');
            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'permission_id']);
        });

        Schema::create('permission_role', function (Blueprint $table) {
          $table->unsignedInteger('permission_id');
          $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');
          $table->unsignedInteger('role_id');
          $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
          $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('categories', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->unsignedInteger('parent_id')->nullable();
          $table->smallInteger('sort')->default(0);
          $table->string('name', 120);
          //$table->string('icon')->nullable();
          //$table->text('description')->nullable();
          //$table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
          $table->timestamps();
        });
  
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('author id');
            $table->string('slug')->unique('slug_unique')->index('slug_index');
            $table->string('title');
            $table->longText('body');
            $table->text('excerpt')->nullable();
            // $table->string('seo_title')->nullable();
            // $table->text('meta_keywords')->nullable();
            // $table->text('meta_description')->nullable();
            $table->string('type', 20)->default('post');
            $table->enum('status', array('PUBLISHED','DRAFT','PENDING'))->default('DRAFT');
            $table->boolean('comment')->default(1)->comment('0:comments Off, 1:comments On');
            $table->unsignedInteger('category_id')->nullable();
            $table->smallInteger('menu_order')->default(0);
            $table->unsignedBigInteger('comment_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();
        });
      
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->primary(['post_id', 'tag_id']);
        });


        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->string('name',50);
            $table->string('url')->nullable();
            $table->string('target', 10)->default('_self');
            $table->string('icon_class', 20)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('body');
            $table->integer('commentable_id');
            $table->string('commentable_type');
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->integer('notifiable_id');
            $table->string('notifiable_type');
            $table->text('body');
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');
        Schema::drop('menus');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('notifications');
    }
}
