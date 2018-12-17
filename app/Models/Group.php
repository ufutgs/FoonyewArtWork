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
    protected $fillable = ['group_name'];
    // protected $hidden = [];
    // protected $dates = [];
/*protected $casts=[
    'leader'=>'array',
    'emails'=>'array'
];*/
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
public function admins()
{
    return $this->hasMany('App\Models\BackpackUser');
}
public function users()
{
    return $this->hasMany('App\Models\User');
}
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

  /*  public function setLeaderAttribute()
    {
        $id = Group::all('id');
        $admin_group_id = BackpackUser::all('id');
        foreach ($id as $ids) {
            if ($admin_group_id->has($ids)==true)
            {
                $this->attributes['leader'] =BackpackUser::where('group_id','=',$ids)->get('name');

            }
            else
            {
                $this->attributes['leader'] =null;

            }
        }

    }

public function setEmailsAttribute()
{
    $id = Group::all('id');
    $admin_group_id = BackpackUser::all('id');
    foreach ($id as $ids) {
        if ($admin_group_id->has($ids)==true)
        {
            $this->attributes['emails'] =BackpackUser::where('group_id','=',$ids)->get('name');

        }
        else
        {
            $this->attributes['emails'] =null;

        }
    }

}*/
}
