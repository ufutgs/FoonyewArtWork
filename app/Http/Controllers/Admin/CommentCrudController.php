<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CommentRequest as StoreRequest;
use App\Http\Requests\CommentRequest as UpdateRequest;

/**
 * Class CommentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CommentCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Comment');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/comment');
        $this->crud->setEntityNameStrings('comment', 'comments');

        $this->crud->setColumns([
            [   // TITLE
                'name' => 'comment',
                'label' => "留言",
                'type' => 'text',
            ],
            [ // POST IMAGE
                'label' => "照片",
                'name' => "CommentPhoto",
                'type' => 'upload_multiple',
                'upload' => true,
                'disk'=>'uploads',
                // ommit or set to 0 to allow any aspect ratio
                //  'prefix' => 'uploads/' // in case you only store the filename in the database, this text will be prepended to the database value
            ],
            [
                'label' => "用户",
                'type' => 'select2',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'username', // foreign key attribute that is shown to user
                'model' => "App\Models\User", // foreign key model

            ],
            [
                'label' => "帖子",
                'type' => 'select2',
                'name' => 'post_id', // the db column for the foreign key
                'entity' => 'post', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "App\Models\Post", // foreign key model
            ]

        ]);



        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns


        // add asterisk for fields that are required in CommentRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
