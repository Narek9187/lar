<?php 							// php artisan make:controller userController

namespace App\Http\Controllers;

// use Validator;							// request և validation սարքելու համար
// use Illuminate\Http\Request;

use App\Http\Requests\registerRequest;	// registred validation
use App\Http\Requests\loginRequest;		// login validation
use App\Http\Requests\updateRequest;

use Illuminate\Support\Facades\Auth;	// Authenfication
use Illuminate\Support\Facades\DB;
use Session;
use App\userModel;
use App\productsModel;
use App\imagesModel;
use App\cartModel;
use App\wishlistModel;
use Hash;
// use DB;
use Validator;
use Mail;



class userController extends Controller
{
	public function __construct()
	{
	    // $this->middleware('guest')->except(["user_profile", "logout"]);
	    // $this->middleware('auth')->except(["login", "reg_form", "logout"]);
        // $this->middleware('auth')->only(["login", "reg_form", "logout"]);
	}

    public function home()
    {
        $p = new productsModel;
        return view("home", ["items" => $p->get()]);
    }


    public function reg_form()  // Register form
    {
    	return view("reg");
    }


    public function form_send(registerRequest $r)   // Register send post
    {
    	// dd($r->name);
    	// dd($r->all());
    	// dd($r["name"]);
		// dd(request("name");		// կվերցնի այն input-ի արժեքը, որի name="name"
		// DB::table("users")->get()	// կցուցադրի դատաբազաի բոլորի տվյալները

        // dd(url()->current());        //  կցուցադրի url-ը 
        // dd(url()->previous());       //  կցուցադրի նախորդից եկած url-ը 

		// $data->where("name", "Narek")->get();	//կցուցադրի նրա տվյալները, ում name-ը Narek է
    	// $data->orderBy("name")->take(2)->get();  //կդասավորի անունների այբենական կարգով, քանակը՝2
    	// $data->orderBy("name")->get();			//կդասավորի անունների այբենական կարգով
    	// $data->inRandomOrder()->get();			//կդասավորի պատահական կարգով;
    	$data = new userModel();
		$data->name = $r->name;
		$data->login = $r->login;
		$data->age = $r->age;
		$data->email = $r->email;
		$data->password = Hash::make($r->password);
		$data->save();

        $d = ["name" => $data->name, "id" => $data->id, "hash" => md5($data->id.$data->email)];
        Mail::send("email", $d, function($m) use($data){
                $m->from("narek9187@gmail.com", "shop admin");
                $m->to($data->email)->subject("Accaunt verification");
            }
        );
		return redirect("/login")->with('good', 'Դուք հաջողությամբ գրանցվել եք, հաստատեք էլ.հասցեն'); // good֊ը ուղարկվում է որպես flash սեսիա
    	// return view("/login", ["data" => userModel::all()]);					//	data-ն ուղարկում ենք որպես փոփոխական
    }


    public function verify($hash, $id)
    {
        $user = userModel::where("id", $id)->first();
        if ($user) {
            if(md5($user->id.$user->email) == $hash){
                userModel::where("id", $id)->update(["active" => 1]);
                return redirect("/login")->with('good', 'էլ․փոստի հասցեն հաստատված է');
            }
        }
  
    }



    public function login()     // Authenfication, SignIn
    {
    	return view("log");
    }


    public function login_send(loginRequest $r)     // Authenfication send post
    {
        $user = userModel::where('email',$r->email)->first();
    	if (!Auth::attempt(request(["email", "password"]))) {
    		return back()->withErrors(["email" => "Տվյալ էլ․հասցեն կամ գաղտնաբառը սխալ է"]);
    	}elseif ($user->active == 0) {
            return back()->withErrors(["email" => "Հաստատեք էլ․ հասցեն"]);
        }

    	return redirect("/user");
    	// session()->put('user', $user);			// սարքում է սեսիա
    	// session(["a" => "abc", "e" => "efj"]);	// սարքում է սեսիա (զանգվածի մեջ միքանի հատ)
    	// session()->pull('cola');					// ջնջում է սեսիան
    }



    public function forgot()
    {
        return view("forgot");
    }



    public function forgot_send()
    {
        $user = userModel::where("email", request("email"))->first();
        if (!$user) {
            return back()->withErrors(["email" => "Տվյալ էլ․հասցեն գոյություն չունի"]);
        }
        $d = ["name" => $user->name, "id" => $user->id, "hash" => md5($user->id.$user->email)];
        Mail::send("reset_email", $d, function($m) use($user){
                $m->from("narek9187@gmail.com", "shop admin");
                $m->to($user->email)->subject("Reset Password");
            }
        );
        return redirect("/login")->with('good', 'Հղումը ուղարկվել է Ձեր էլ․փոստի հասցեին');
    }



    public function new_password($id)
    {
        return view("new_password", ["id" => $id]);
    }



    public function reset_password($id)
    {
        $v = request()->validate([
            'password' => 'required|min:8|max:15|regex:/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])/',
            "confirm" => "required|same:password"
        ]);
        $user = userModel::where("id", $id)->first();
        if ($user) {
            userModel::where("id", $id)->update(["password" => Hash::make($v["password"])]);
            return redirect("/login")->with('good', 'Գաղտնաբառը փոխված է');
        }
  
    }




    public function user_profile()      // user profile
    {	
    	if (!Auth::check()) {
    		return redirect("/login")->withErrors(["email" => "Մուտքագրե՛ք տվյալները"]);
    	}
    	return view("user", ["items" => productsModel::where('users_id', Auth::user()->id)->get()]);
    }

	


    public function logout()        // logout profile
    {
    	Auth::logout();
    	return redirect("/login");
    }


    public function settings()      // Profile Settings
    {	
    	if (!Auth::check()) {
    		return redirect("/login")->withErrors(["email" => "Մուտքագրե՛ք տվյալները"]);
    	}
    	return view("settings");
    }


    public function update(updateRequest $r)    // Change Profile
    {
        $all = DB::select("select * from users");
    	foreach ($all as $key) {
            if(((($r->email != $key->email && $r->email == Auth::user()->email) || ($r->email != $key->email && $r->email != Auth::user()->email)) || (($r->login != $key->login && $r->login == Auth::user()->login) || ($r->login != $key->login && $r->login != Auth::user()->login))) && $r->login != $key->login){
                userModel::where('id', Auth::user()->id)->update(['name'=>$r->name, 'age'=>$r->age, 'login'=>$r->login, 'email'=>$r->email]);
            }
       
    		else{
    			return back()->with('good', 'Նշված հասցեն զբաղված է');
    		}
    	}
        return back()->with('good', 'Տվյալները հաջողությամբ փոխվել են');
    }


    public function reset()     // Change Password
    {
        $v = request()->validate([
            "current" => 'required|min:8|max:15|regex:/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])/',
            "new" => 'required|min:8|max:15|regex:/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])/',
            "repeat" => "required|same:new"
        ]);
       
        if (!Hash::check($v["current"], Auth::user()->password)) {
            return back()->with('err', 'Գաղտնաբառը սխալ է մուտքագրված');
        }else{userModel::where('id', Auth::user()->id)->update(["password" => Hash::make($v["new"])]);}
       
        return back()->with('good', 'Գաղտնաբառը հաջողությամբ փոխվել է');
    }


}
