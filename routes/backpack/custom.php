<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    CRUD::resource('post','PostCrudController');
    CRUD::resource('comment','CommentCrudController');
    CRUD::resource('forum','ForumCrudController');
    CRUD::resource('event','EventCrudController');
    CRUD::resource('user','UserCrudController');
    CRUD::resource('admin_back_door_high_five','AdminCrudController');
    // custom admin routes
}); // this should be the absolute last line of this file
