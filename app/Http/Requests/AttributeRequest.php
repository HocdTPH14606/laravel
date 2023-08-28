<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request)
    {  
        $rules = [];
        $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động 

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                        // nếu là method thêm mới bản ghi
                    case 'store1':
                        $rules = [ 
                            'name' => 'required|unique:attributes|string|max:255|min:1'
                        ];
                        break;
                        // nếu là method chỉnh sửa bản ghi
                    case 'update1':
                        $rules = [ 
                            'name' => 'unique:attributes,name,' . $this->id, '|string|max:255|min:1'
                        ];
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [ 
            'name.required' => 'Không được để trống',
            'name.string' => 'Giá trị chưa đúng định dạng',
            'name.unique' => 'Giá trị đã tồn tại',
            'name.max' => 'Giá trị tối đa 255 ký tự',
            'name.min' => 'Giá trị tối thiểu 1 ký tự'
        ];
    } 
}
