<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\VoteRequest as StoreRequest;
use App\Http\Requests\VoteRequest as UpdateRequest;

/**
 * Class VoteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class VoteCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Vote');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/vote');
        $this->crud->setEntityNameStrings('vote', 'votes');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addFields([
            [
                'label' => "用户",
                'type' => 'select2',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'username', // foreign key attribute that is shown to user
                'model' => "App\Models\User", // foreign key model

            ],
            [   // TITLE
                'name' => 'title',
                'label' => "标题",
                'type' => 'text',
            ],
            [   // DESCRIPTION
                'name' => 'description',
                'label' => "内容",
                'type' => 'textarea',
            ],
            [ // POST IMAGE
                'label' => "照片",
                'name' => "VotePhoto",
                'type' => 'upload_multiple',
                'upload' => true,
                'disk'=>'uploads',
                // ommit or set to 0 to allow any aspect ratio
                //  'prefix' => 'uploads/' // in case you only store the filename in the database, this text will be prepended to the database value
            ],
            [   // VIDEO
                'name' => 'video',
                'label' => '影片',
                'type' => 'video',
            ]
        ]);
        $this->crud->addcolumns([
            [
                'label' => "用户",
                'type' => 'select',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'username', // foreign key attribute that is shown to user
                'model' => "App\Models\User", // foreign key model

            ],
            [   // TITLE
                'name' => 'title',
                'label' => "标题",
                'type' => 'text',
            ],
            [   // DESCRIPTION
                'name' => 'description',
                'label' => "内容",
                'type' => 'textarea',
            ],
            [ // POST IMAGE
                'label' => "照片",
                'name' => "VotePhoto",
                'type' => 'upload_multiple',

            ],
            [   // VIDEO
                'name' => 'video',
                'label' => '影片',
                'type' => 'video',
            ]
        ]);

        // add asterisk for fields that are required in VoteRequest
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
