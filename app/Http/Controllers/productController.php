<?php

namespace App\Http\Controllers;

use App\Events\TaskEvent;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\userModel;
use App\productsModel;
use App\imagesModel;
use App\cartModel;
use App\wishlistModel;
use App\messageModel;
use Hash;
use DB;
use Validator;

class productController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except(["user_profile", "logout"]);
        // $this->middleware('auth')->except(["login", "reg_form", "logout"]);
        // $this->middleware('auth')->only(["login", "reg_form", "logout"]);
        $this->middleware('auth');
    }

    

    public function prod()  // products save in DB
    {
    	$v = request()->validate([
            "name" => "required",
            "count" => "required|integer",
            "price" => "required|integer",
            "description" => "required",
            "img" => "required"
        ]);

                
    	$products = new productsModel();
    	$products->name = $v["name"];
    	$products->count = $v["count"];
    	$products->price = $v["price"];
    	$products->description = $v["description"];
    	$products->users_id = Auth::user()->id;
    	$products->save();


        if (request()->hasfile("img")) {
            foreach (request("img") as $img) {
                $address = time().$img->getClientOriginalName();
                $img->move(public_path()."/images/", $address);

                $nk = new imagesModel();
                $nk->img = $address;
                $nk->products_id = $products->id;
                $nk->save();
            }
        }

    	return redirect("/user");
    }



    public function edit(Request $r)              // products edit in DB
    {
        $v = Validator::make($r->all(),[
            "n" => "required",
            "c" => "required|integer",
            "p" => "required|integer",
            "d" => "required"
        ]);

        productsModel::where('users_id', Auth::user()->id)->where('id',$r->id)->update(
           [ "name" => $r->n, "price" => $r->p, "count" => $r->c, "description" => $r->d] 
        );
    }


    public function detail($id)
    {
        $d = productsModel::find($id);
        return view('detail')->with('data',$d);
    }


    public function delete($id)     // products delete in DB
    {   
        productsModel::find($id)->delete();
        return back();
    }


    public function wishlist()      //  wishlist
    {
        $wishlist = wishlistModel::where("users_id", Auth::user()->id)->get();
        return view('wishlist', ["items" => $wishlist]);
    }


    public function add_wishlist(Request $r)  //  add wishlist
    {
        $pm = productsModel::where('id' , $r->id)->first();
        $data = new wishlistModel;
        $data->products_id = $pm->id;
        $data->users_id = Auth::user()->id;
        $data->save();
    }


    public function rm_wishlist(Request $r)     //  remove from wishlist
    {
        wishlistModel::all()->find($r->id)->delete();
    }


    public function move_cart(Request $r)     //  move to wishlist
    {
        $wish = wishlistModel::where('id', $r->id)->first();
        $pr = productsModel::where('id', $wish->products_id)->first();

        $data = new cartModel;
        $data->products_id = $wish->products_id;
        $data->users_id = Auth::user()->id;
        $data->count = $pr->count;
        $data->save();

        wishlistModel::all()->find($r->id)->delete();

        $c = DB::table("cart")->where('users_id', Auth::user()->id)->count('*');
        echo $c;
    }







    public function cart()          //  cart
    {
        $cart = cartModel::where("users_id", Auth::user()->id)->get();
        return view('cart', ["items" => $cart]);
    }


    public function add_cart(Request $r)      //  add cart
    {
        $pm = productsModel::where('id' , $r->id)->first();
        $data = new cartModel;
        $data->products_id = $pm->id;
        $data->users_id = Auth::user()->id;
        $data->count = 1;
        $data->save();
        $c = DB::table("cart")->where('users_id', Auth::user()->id)->count('*');
        echo $c;
    }


    public function rm_cart(Request $r)     //  remove from cart
    {
        cartModel::all()->find($r->id)->delete();

        $c = DB::table("cart")->where('users_id', Auth::user()->id)->count('*');
        echo $c;
    }


    public function move_wishlist(Request $r)     //  move to wishlist
    {
        $pm = cartModel::where('id', $r->id)->first();
        $data = new wishlistModel;
        $data->products_id = $pm->products_id;
        $data->users_id = Auth::user()->id;
        $data->save();

        cartModel::all()->find($r->id)->delete();

        $c = DB::table("cart")->where('users_id', Auth::user()->id)->count('*');
        echo $c;
    }



    public function home_unlike(Request $r)     // from home page unlike item
    {
        $a = wishlistModel::where("products_id", $r->id)->delete();

        $c = DB::table("cart")->where('users_id', Auth::user()->id)->count('*');
        echo $c;
    }


    public function cart_count(Request $r)
    {
        $v = Validator::make($r->all(),[
            "c" => "required|integer|max:$r->max"
        ]);

        cartModel::where('users_id', Auth::user()->id)->where('id', $r->id)->update(["count" => $r->c]);
        $price = productsModel::where('id', $r->prod_id)->first()->price;
        echo $price * $r->c;
    }


    public function chat()
    {
        return view("listenBroadcast");
    }


    public function sendChat(request $request)
    {
        $this->saveToSession($request);
        $user = userModel::find(Auth::id());
        event(new TaskEvent($request->message, $user->login));
    }


    public function oldMessages()
    {
        return session("chat");
        
    }

    public function saveToSession(request $request)
    {
        session()->put("chat", $request->chat);
    }

    public function delSession()
    {
        session()->pull("chat");
    }

}
