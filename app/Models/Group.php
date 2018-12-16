<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Group extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'groups';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['group_name','leader','email'];
    // protected $hidden = [];
    // protected $dates = [];
protected $casts=[
    'leader'=>'array',
    'emails'=>'array'
];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setLeaderAttribute()
    {
        $id = Group::all('id');
        $admin_group_id = BackpackUser::all('id');
        foreach ($id as $ids) {
            if ($admin_group_id->has($ids)==true)
            {
                $this->attributes['leader'] =BackpackUser::where('group_id','=',$ids)->get('name');
                $this->attributes['emails']=BackpackUser::where('group_id','=',$ids)->get('email');
            }
            else
            {
                $this->attributes['leader'] =null;
                $this->attributes['emails']=null;
            }
        }

    }


}
