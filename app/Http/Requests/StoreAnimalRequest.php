<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalRequest extends FormRequest
{
    /**
     * 確認是否確認用戶有沒有權限請求
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 撰寫請求表單的規格
     *
     * @return array
     */
    public function rules()
    {
        // app/Http/Controllers/AnimalController.php 中 store 方法中之前寫的驗證表單規格複製過來 
        return [
            'type_id' => 'required',
            'name' => 'required|max:255',
            'birthday' => 'required|date',
            'area' => 'required|max:255',
            'fix' => 'required|boolean',
            'description' => 'nullable',
            'personality' => 'nullable'
        ];
    }
}
