<?php                           // php artisan make:request loginRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            "email" => "required|email|max:30|exists:users,email",
            "password" => "required|min:8|max:30|regex:/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])/"
        ];
    }

    public function messages()
    {
        return [
            "required" => "Լրացրե՛ք բաց թողնված դաշտը",
            "*" => "Տվյալ էլ․հասցեն կամ գաղտնաբառը սխալ է"
        ];
    }
}
