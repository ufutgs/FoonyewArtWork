<?php

namespace App\Http\Controllers\Admin;

use App\User;
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
        $this->crud->setModel('App\Models\BackpackUser');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addFields([
            [   // Text
                'name' => 'name',
                'label' => "名字",
                'type' => 'text',
            ],
            [   // Text
                'name' => 'username',
                'label' => "昵称",
                'type' => 'text',
            ],
        [   // Text
                'name' => 'email',
                'label' => "Email",
                'type' => 'email',
            ],



          [ // image
                'label' => "个人照片",
                'name' => "ProfilePhoto",
                'type' => 'image',
                'upload' => true,
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 0,
              // ommit or set to 0 to allow any aspect ratio
             //  'prefix' => 'uploads/' // in case you only store the filename in the database, this text will be prepended to the database value
            ],
            [
                // 1-n relationship
                'label' => "团体", // Table column heading
                'type' => "select2",
                'name' => 'group_id', // the column that contains the ID of that connected entity;
                'entity' => 'group', // the method that defines the relationship in your Model
                'attribute' => "group_name", // foreign key attribute that is shown to user
                'model' => "App\Models\Group", // foreign key model
            ],
            [
                'label'=>'*是会长的就打勾',
                'name'=>'is_admin',
                'type'=>'checkbox',
            ],
        ]);
        $this->crud->addColumns(
            [ [   // Text
                'name' => 'name',
                'label' => "名字",
                'type' => 'text',
            ],
                [   // Text
                    'name' => 'username',
                    'label' => "昵称",
                    'type' => 'text',
                ],
                [   // Text
                    'name' => 'email',
                    'label' => "Email",
                    'type' => 'email',
                ],
                [ // image
                    'label' => "个人照片",
                    'name' => "ProfilePhoto",
                    'type' => 'image',
                ],
                [
                    'label' => "团体",
                    'type' => "select",
                    'name' => 'group_id',
                    'entity' => 'group', // the method that defines the relationship in your Model
                    'attribute' => "group_name", // foreign key attribute that is shown to user
                    'model' => "App\Models\Group", // foreign key model
                ],
                [
                    'label'=>'会长',
                    'name'=>'is_admin',
                    'type'=>'boolean',
                ],]

        );


        // TODO: remove setFromDb() and manually define Fields and Columns


        // add asterisk for fields that are required in UserRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {

        if(User::all('back_door')->count()>'2'||User::all('back_door')->count()=='2')
        {

          $request->request->add(['back_door'=>'0']);

        }
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
