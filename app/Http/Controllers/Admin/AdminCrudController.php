<?php

namespace App\Http\Controllers\Admin;
use App\models\BackpackUser;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CommentRequest as StoreRequest;
use App\Http\Requests\CommentRequest as UpdateRequest;

/**
 * Class CommentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AdminCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\BackpackUser');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/admin_back_door_high_five');
        $this->crud->setEntityNameStrings('admin', 'admins');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addFields([
            [   // Text
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
            ],
            [
                'name' => 'username',
                'label' => "Username",
                'type' => 'text',
            ],
            [   // Text
                'name' => 'email',
                'label' => "Email",
                'type' => 'email',
            ],

            [   // Text
                'name' => 'password',
                'label' => "Password",
                'type' => 'password',
            ],

            [ // image
                'label' => "Profile pic",
                'name' => "ProfilePhoto",
                'type' => 'image',
                'upload' => true,
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 0,
                // ommit or set to 0 to allow any aspect ratio
                //  'prefix' => 'uploads/' // in case you only store the filename in the database, this text will be prepended to the database value
            ],
            [   // Checkbox
                'name' => 'back_door',
                'label' => 'Back_door',
                'type' => 'checkbox'
            ],
        ]);
        $this->crud->setColumns(
            ['name','username','email']
        );
        $this->crud->addColumns(
            [[
            'name' => 'ProfilePhoto', // The db column name
            'label' => "Profile image", // Table column heading
            'type' => 'image',
        ],
            [
                'name' => 'back_door',
                'label' => 'Backdoor',
                'type' => 'boolean',
        ]
        ]);


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
