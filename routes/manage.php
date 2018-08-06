<?php
Route::namespace('Manage')->prefix('manage')->group(function(){
 
    Route::get('/login', 'ManageLoginController@showLoginForm')->name('manage.login');
    Route::post('/login', 'ManageLoginController@login')->name('manage.login.submit');

    //middleware
   // Route::group(['middleware' => ['auth:manage','role:super|admin|editor']], function (){
    Route::group(['middleware' => ['auth:manage','role:super|admin|editor']], function (){
      
        Route::post('/logout', 'ManageLoginController@logout')->name('manage.logout');

        Route::get('/dashboard', 'ManageBoardController@dashboard')->name('manage.dashboard');

        // with permissions
        Route::group(['middleware' => 'permission'], function (){

            Route::name('manage.')->group(function(){
              Route::resources([
                'users'       =>  'ManageUsersController',
                'roles'       =>  'ManageRolesController',
                'categories'  =>  'ManageCategoriesController',
                'menus'       =>  'ManageMenusController',
                'posts'       =>  'ManagePostsController',
              ]);
            });


        // permissions
        });

    //middleware   
    });
});

