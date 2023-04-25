<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // ログを利用する場合
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;
use App\Mail\FormAdminMail;
use App\Mail\FormUserMail;


class FormController extends Controller
{
    /**
     * 入力ページ
     */
    public function index()
    {
      return view('form.index');
    }
    
    /**
     * 完了ページ
     */
    public function complete()
    {
      return view('form.complete');
    }
    
    /**
      * メール送信
      */
     public function sendMail(ContactFormRequest $request)
    {
          // バリデーション済みのフォームデータを取得
        $form_data = $request->validated();
        
        
          // OTAへの送付チェックボックスの値を取得
          $email_admin1 = $request->input('no1-checkbox');
          $email_admin2 = $request->input('no2-checkbox');
          
     
           // メールを送信する処理を実装
          if ($email_admin1) {
            // ユーザー1にメールを送信する処理
            // 例えば、Mail クラスを使用してメールを送信する
            Mail::to('testno1202304@gmail.com')->send(new FormAdminMail($form_data));
          }
          
          if ($email_admin2) {
            // ユーザー2にメールを送信する処理
            // 例えば、Mail クラスを使用してメールを送信する
            Mail::to('testono2202304@gmail.com')->send(new FormAdminMail($form_data));
          }
                  

            // 送信先メールアドレスを取得
            //$email_admin = 'testno1202304@gmail.com , testono2202304@gmail.com';
            $email_user  = $form_data['email_my'];
             
              // OTA宛メール
              //Mail::to(explode(',', $email_admin))->send(new FormAdminMail($form_data));
              // ユーザー宛メール
              Mail::to($email_user)->send( new FormUserMail($form_data) );

            return to_route('form.complete');
        //     // 一時保存したExcelファイルを削除
        //     unlink(storage_path('app/' . $excel_file_path));

        //     // 送信完了メッセージを表示
        //     return redirect()->route('form.complete')->with('success', 'メールを送信しました。');
        // } else {
        //     // emailキーが存在しない場合のエラー処理
        //     return redirect()->back()
        //         ->withErrors(['email' => 'メールアドレスを入力してください。'])
        //         ->withInput($request->except('email'));
        // }
        
    }
}
