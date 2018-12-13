<?php

namespace App\Models;

use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BackpackUser extends Authenticatable
{

    protected $table = 'admins';
    protected $guarded = ['id'];
    protected $fillable = ['name','username','email','email_verified','password','ProfilePhoto','back_door'];
    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */
    /**
     * Send the password reset notification.
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            \Storage::disk('uploads')->delete($obj->ProfilePhoto);
        });
    }
    /*
 |--------------------------------------------------------------------------
 | FUNCTIONS
 |--------------------------------------------------------------------------
 */
public function events()
{
    return $this->hasMany('App\Models\Event');
}
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
    public function setProfilePhotoAttribute($value)
    {
        $attribute_name = "ProfilePhoto";
        $disk = "uploads";
        $destination_path = "uploads/photo";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }

}
