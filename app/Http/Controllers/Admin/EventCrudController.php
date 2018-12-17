<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EventRequest as StoreRequest;
use App\Http\Requests\EventRequest as UpdateRequest;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Event');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/event');
        $this->crud->setEntityNameStrings('event', 'events');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addFields([
            [
                'label' => "上传者",
                'type' => 'select2',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'admin', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\BackpackUser", // foreign key model

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
                'name' => "EventPhoto",
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
            ],
          ]);
        $this->crud->setColumns([
            [
                'label' => "上传者",
                'type' => 'select',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'admin', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\BackpackUser", // foreign key model

            ],
            [   // TITLE
                'name' => 'title',
                'label' => "标题",
                'type' => 'text',
            ],
            [   // DESCRIPTION
                'name' => 'description',
                'label' => "内容",
                'type' => 'text',
            ],
            [
                'label' => "照片",
                'name' => "EventPhoto",
                'type' => 'upload_multiple',

            ],
            [   // VIDEO
                'name' => 'video',
                'label' => '影片',
                'type' => 'video',
            ]
        ]);

        // TODO: remove setFromDb() and manually define Fields and Columns


        // add asterisk for fields that are required in EventRequest
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
