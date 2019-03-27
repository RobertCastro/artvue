<?php




Route::get('/', 'PagesController@home');
Route::get('blog/{post}', 'PostController@show')->name('posts.show');
Route::get('categoria/{category}', 'categoriesController@show')->name('categories.show');

 


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {

    Route::get('/', 'AdminController@index')->name('dashboard');

    // Route::get('/', 'PagesController@index')->name('dashboard');

    Route::resource('posts', 'PostsController', ['except'=>'show', 'as'=> 'admin']);

    Route::resource('users', 'UsersController', ['as'=> 'admin']);

    Route::resource('roles', 'RolesController', ['as'=> 'admin']);

    Route::resource('pages', 'PagesController', ['as'=> 'admin']);
    // Route::get('pages', 'PagesController@index')->name('admin.pages.index');
    Route::put('pages/deactivate/{id}', 'PagesController@deactivate')->name('admin.pages.deactivate');
    Route::put('pages/activate/{id}', 'PagesController@activate')->name('admin.pages.activate');

    Route::resource('codes', 'CodesController', ['as'=> 'admin']);

    Route::get('cron', 'CronController@index')->name('cron');

    // actualizar roles
    Route::middleware('permission:Update roles')
    ->put('users/{user}/role', 'UsersRolesController@update')
    ->name('admin.users.roles.update');
    // actualizar permisos
    Route::middleware('permission:Update roles')->put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');


    // Route::get('posts', 'PostsController@index')->name('admin.posts.index');
    // MOSTRAR FORMULARIO DE CREACION DE POST
    // Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
    // AÑADIR NUEVO POST
    // Route::post('posts', 'PostsController@store')->name('admin.posts.store');
    // Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
    // ACTUALIZAR UN POST
    // Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
    // ELIMIAR UN Post
    // Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');



    // ACTUALIZAR UN POST
    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
    // ELIMMINAR UN Photo
    Route::delete('photos/{photo}', 'PhotosController@destroy' )->name('admin.photos.destroy');
});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
