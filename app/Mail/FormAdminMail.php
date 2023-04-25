<?php

/**
 * 管理者宛てメール 
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;

class FormAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    //public $form_data; // フォームデータを格納するプロパティ
    
    public function __construct(public array $form_data)
    {
      //$this->form_data = $form_data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
      $from    = new Address('h.maeda0730@gmail.com', 'お申込みフォーム');
      $subject = 'お申込みがありました';
    
      //return (new \Illuminate\Mail\Mailables\Envelope)->from($from)->subject($subject);
        return new Envelope(
        from: $from,
        subject: $subject,
        );
    }
    
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
      //return (new Content)->text('emails.form.admin'); // プレーンテキストで送信
       return new Content(
       // view: 'emails.form.admin',
       text: 'emails.form.admin',
       ); // プレーンテキストで送信
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
    
    public function build()
    {
        return $this->markdown('emails.form.admin') // 管理者宛メールのマークダウンビューを指定
            ->with(['form_data' => $this->form_data]) // フォームデータをビューに渡す
            ->subject('お申込がありました'); // メールの件名を指定
    }
}