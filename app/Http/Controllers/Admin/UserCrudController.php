<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addField(
            [   // Text
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
            ]);
        $this->crud->addField( [   // Text
                'name' => 'username',
                'label' => "Username",
                'type' => 'text',
            ]);
        $this->crud->addField(  [   // Text
                'name' => 'email',
                'label' => "Email",
                'type' => 'text',
            ]);
        $this->crud->addField(  [   // Text
                'name' => 'email_verified',
                'label' => "Email Verified",
                'type' => 'text',
            ]);
        $this->crud->addField( [   // Text
                'name' => 'password',
                'label' => "Password",
                'type' => 'text',
            ]);

            $this->crud->addField([ // image
                'label' => "Profile Image",
                'name' => "ProfilePhoto",
                'type' => 'image',
                'upload' => true,
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1.9,
              // ommit or set to 0 to allow any aspect ratio
             //  'prefix' => 'uploads/' // in case you only store the filename in the database, this text will be prepended to the database value
            ]);
        $this->crud->setColumns(
            ['name','username','email','email_verified','password']

        );
        $this->crud->addColumn([
            'name' => 'ProfilePhoto', // The db column name
            'label' => "Profile image", // Table column heading
            'type' => 'image',
        ]);


        // TODO: remove setFromDb() and manually define Fields and Columns


        // add asterisk for fields that are required in UserRequest
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
