<?php                           // php artisan make:request registerRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|min:2|max:15|alpha",
            "login" => "required|min:5|max:15|alpha_num|different:name|unique:users,login",
            "age" => "required|min:16|max:60|integer",
            "email" => "required|email|max:30|unique:users,email",
            'password' => 'required|min:8|max:15|regex:/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])/',
            "confirm" => "required|same:password",
            "accept" => "accepted"
        ];
    }

    public function messages()
    {
        return [
            "required" => "Լրացրե՛ք բաց թողնված դաշտը",
            "age.min" => "Սխալ",
            "login.unique" => "Տվյալ մուտքանունը գոյություն ունի",
            "email.email" => "Սխալ էլ․փոստի հասցե",
            "email.unique" => "Տվյալ էլ․հասցեն գոյություն ունի",
            'password.regex' => 'Գաղտնաբառը պետք է պարունակի՝ Aa8!'
        ];
    }
}
