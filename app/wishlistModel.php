<?php 									// php artisan make:model wishlistModel

namespace App;

use Illuminate\Database\Eloquent\Model;

class wishlistModel extends Model
{
    public $table = "wishlist";
    public $timestamps = false;

     public function prod()
    {
    	return $this->belongsTo("App\productsModel", "products_id", "id");
    }
}
