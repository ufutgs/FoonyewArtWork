<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GroupRequest as StoreRequest;
use App\Http\Requests\GroupRequest as UpdateRequest;

/**
 * Class GroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class GroupCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Group');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/group');
        $this->crud->setEntityNameStrings('group', 'groups');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
$this->crud->addField([

        'name'=>'group_name',
        'label'=>'团体',
        'type'=>'text'
]);

$this->crud->setColumns([
    [
        'name'=>'group_name',
        'label'=>'团体',
        'type'=>'text'
    ],
    [
        'name'=>'leader',
        'label'=>'会长',
        'type'=>'model_function_attribute',
        'function_name'=>'setLeaderAttribute',
        'attribute'=>'leader'
    ],
    [
        'name'=>'emails',
        'label'=>'Email',
        'type'=>'model_function_attribute',
        'function_name'=>'setLeaderAttribute',
         'attribute'=>'emails'
    ]
]);
        // TODO: remove setFromDb() and manually define Fields and Columns


        // add asterisk for fields that are required in GroupRequest
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
