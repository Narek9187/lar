<?php 									// php artisan serve

										// php artisan make:model userModel	=> model stexcelu hamar for database

// Route::get('/', function () {
//     return view('home');
// });						//	հին գրելաձև

Route::get("/", "userController@home");	//	նոր գրելաձև

// event & listen, messenger
Route::get("/listen", "productController@chat");
Route::post("/event", "productController@sendChat");

Route::post("/saveToSession", "productController@saveToSession");
Route::post("/oldMessages", "productController@oldMessages");
Route::post('delSession','productController@delSession');

// ===== redirect => երթուղին փոխելու համար
Route::redirect('/super', "/");

// registration form
Route::get('/register', "userController@reg_form");
Route::post('/form_send', "userController@form_send");
// login form
Route::get('/login', "userController@login");
Route::post('/login_send', "userController@login_send");

// send email
Route::get('account/verify/{hash}/{id}', "userController@verify");

// forgot password
Route::get('/forgot', "userController@forgot");
// send email for password
Route::get('/forgot_send', "userController@forgot_send");
// new password
Route::get('/new_password/{id}', "userController@new_password");
// reset password
Route::get('/reset_password/{id}', "userController@reset_password");


// profile reg account
Route::get('/user', "userController@user_profile")->middleware('checklogin');
Route::post('/prod', "productController@prod");

// Profile & Password change
Route::get('/user/settings', "userController@settings");
Route::post('/user/settings', "userController@update");
Route::post('/user/reset', "userController@reset");

// items delete
Route::get('/user/{id}/delete', "productController@delete")->name("delete"); // կարող ենք անուն տալ,իսկ վերցնելուց գրենք route('delete') 

// item detail
Route::get('/user/{id}/detail', "productController@detail")->name("detail"); // կարող ենք անուն տալ,իսկ վերցնելուց գրենք route('delete') 

// items edit
Route::post('/user/edit', "productController@edit");		// ajax

// add to cart
Route::get('/user/cart', "productController@cart")->name("cart");
Route::post('/user/cart', "productController@add_cart");
// rm from cart
Route::post('/user/cart/rm', "productController@rm_cart");
// move to wishlist
Route::post('/user/cart/move', "productController@move_wishlist");
// cart item count
Route::post('/user/cart/count', "productController@cart_count");


// add wishlist
Route::get('/user/wishlist', "productController@wishlist")->name("wishlist");
Route::post('/user/wishlist', "productController@add_wishlist");
// rm from wishlist
Route::post('/user/wishlist/rm', "productController@rm_wishlist");
// move to card
Route::post('/user/wishlist/move', "productController@move_cart");


// home unlike
Route::post('/wishlist/rm', "productController@home_unlike");

// Logout
Route::get('/logout', "userController@logout");


// card
Route::get('stripe', 'stripeController@stripe');
Route::post('stripe', 'stripeController@stripePost')->name('stripe.post');