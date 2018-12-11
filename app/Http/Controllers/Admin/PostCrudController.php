<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PostRequest as StoreRequest;
use App\Http\Requests\PostRequest as UpdateRequest;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Post');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/post');
        $this->crud->setEntityNameStrings('post', 'posts');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addFields([
            [
                'name' => 'user_id',
                'label' => 'User Id',
                'type' => 'number',
            ],
            [   // TITLE
                'name' => 'title',
                'label' => "Title",
                'type' => 'text',
            ],
            [   // DESCRIPTION
                'name' => 'description',
                'label' => "Description",
                'type' => 'textarea',
            ],
        [ // POST IMAGE
            'label' => "Post Image",
            'name' => "post_photo",
            'type' => 'image',
            'upload' => true,
            'aspect_ratio' =>0,
            // ommit or set to 0 to allow any aspect ratio
            //  'prefix' => 'uploads/' // in case you only store the filename in the database, this text will be prepended to the database value
        ],
        [   // VIDEO
            'name' => 'video',
            'label' => 'Video',
            'type' => 'video',
        ]
]);
        $this->crud->setColumns(
            ['title','description',"post_photo",'video']
        );
        // TODO: remove setFromDb() and manually define Fields and Columns


        // add asterisk for fields that are required in PostRequest
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
