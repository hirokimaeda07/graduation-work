<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    /**
      * バリデーションルール
      *
      * @return array<string, mixed>
      */
    public function rules()
    {
      // $file = $this->hasFile('attachment') ? $this->file('attachment') : null; // $file 変数を定義し、'attachment' キーが存在する場合にその値を代入する

      $rules = [
        'company'   => ['required', 'string', 'max:30'],
        'name'      => ['required', 'string', 'max:30'],
        'name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ロワンヴー]*$/u'],
        'phone'     => ['nullable', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
        'email_my'     => ['required', 'email'],
        'body'      => ['required', 'string', 'max:1000'],
        //'file'      => ['nullable', 'file', 'max:2048', 'mimes:pdf,jpeg,png,xlsx,xls'], // 添付ファイルのバリデーションルールを定義
        // 'file' => $this->hasFile('file') ? $this->file('file') : null,// ファイル名を取得する
        //'attachment' => ['nullable', 'file', 'max:2048'], // 追加: 添付ファイルのバリデーションルールを定義
      ];
        //   if ($this->hasFile('attachment')) { // 添付ファイルがある場合のみルールを追加
        //   $rules['attachment'] = ['nullable', 'file', 'max:2048'];
        // }
    
      //         
      //return [
            // その他のフォームフィールドのバリデーションルール
            //'file' => 'file|mimes:pdf,jpeg,png,xlsx,xls|max:2048',
      //];
      
      
      return $rules;
    }
    
     /**
      * 属性名
      * /lang/ja/validation.php で指定した内容を変更する場合に設定
     */
    public function attributes()
    {
      // 
      return [
        'company'   => '会社・組織名',
        // 'name'      => '氏名',
        // 'name_kana' => 'フリガナ',
        // 'phone'     => '電話番号',
        // 'email'     => 'メールアドレス',
        'body'      => 'お問い合わせ内容',
        //'file' => '添付ファイル', 
      ];
    }
    
     /**
      * エラーメッセージ
     */
    public function messages()
    {
      // 
      return [
        'name.required' => ':attributeは必須項目です。',
        'phone.regex'   => ':attributeが正しくありません。'
      ];
    }
    
}
