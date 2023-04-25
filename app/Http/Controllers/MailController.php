<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttachmentMail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // ファイルの検証
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpeg,png,xlsx,xls|max:2048', // アップロード可能なファイル形式やサイズを指定
        ]);

        // ファイルをアップロード
        $file = $request->file('file');
        $path = $file->store('temp'); // アップロードされたファイルを一時的に保存するディレクトリを指定

        // メールを送信
        Mail::to('example@example.com')->send(new AttachmentMail($path));

        // ファイルを削除
        Storage::delete($path);

        // リダイレクトなどの処理を追加
    }
}
