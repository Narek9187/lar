<?php 								// php artisan make:model userModel

namespace App;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    public $table = "users";
    public $timestamps = false;
}
