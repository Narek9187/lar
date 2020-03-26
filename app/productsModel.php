<?php 											// php artisan make:model productsModel

namespace App;

use Illuminate\Database\Eloquent\Model;

class productsModel extends Model
{
    public $table = "products";
    public $timestamps = false;

    public function seller()
    {
    	return $this->belongsTo("App\userModel", "users_id", "id");    // մեկը միքանիսին
    }

    public function photo()
    {
    	return $this->hasMany("App\imagesModel", "products_id", "id"); // միքանիսը մեկին
    }
}
