<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Post extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'posts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
     protected $guarded = ['id'];
    protected $fillable = ['user_id','title','PostPhoto','video','description'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj)
        {if (count((array)$obj->PostPhoto)) {
                foreach ($obj->PostPhoto as $file_path) {
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
public function user()
{
  return  $this->belongsTo('App\Models\User');
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
    public function setPostPhotoAttribute($value)
    {
        $attribute_name = "PostPhoto";
        $disk = "uploads";
        $destination_path = "uploads/post_photo";
    $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);


    }
/*|--------------------------------------------------------------------------
| Attribute Casting
|--------------------------------------------------------------------------
*/
protected $casts=[
    'PostPhoto'=>'array',
    'video'=>'array',
];

}
