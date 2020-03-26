<?php 									// php artisan make:model cartModel

namespace App;

use Illuminate\Database\Eloquent\Model;

class cartModel extends Model
{
    public $table = "cart";
    public $timestamps = false;

    public function prod()
    {
    	return $this->belongsTo("App\productsModel", "products_id", "id");
    }


}
