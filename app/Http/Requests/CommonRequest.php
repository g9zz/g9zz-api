<?php

namespace App\Http\Requests;

use App\Exceptions\ValidatorException;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class CommonRequest extends FormRequest
{
    public $key = 'default';
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
            //
        ];
    }

    /**
     * 重写message，验证信息自定义
     * @return array|mixed
     */
    public function messages()
    {
        $validation = config('validation.validation');
        $validation = isset($validation[$this->key]) ? array_merge($validation['default'], $validation[$this->key]) : $validation['default'];
        return $validation;
    }

    /**
     * 重写校验失败的方法
     * @param Validator $validator
     * @throws ValidatorException
     */
    public function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            $code = (int)$validator->errors()->first();
            throw new ValidatorException($code);
        }
    }
}
