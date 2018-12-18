<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Vote extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'votes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title','user_id','description','url','VotePhoto','video'];
    // protected $hidden = [];
    // protected $dates = [];
protected $casts=[
    'VotePhoto'=>'array',
    'video'=>'array'
];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj)
        {if (count((array)$obj->VotePhoto)) {
            foreach ($obj->VotePhoto as $file_path) {
                \Storage::disk('uploads')->delete($file_path);
            }
        }
        });

    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
public function admin()
{
    return $this->belongsTo('App\Models\BackpackUser');
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
    public function setVotePhotoAttribute($value)
    {
        $attribute_name = "VotePhoto";
        $disk = "uploads";
        $destination_path = "uploads/vote_photo";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }

}
