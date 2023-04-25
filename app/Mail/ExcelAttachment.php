<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExcelAttachment extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $filePath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filePath)
    {
         $this->filePath = $filePath;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Excel Attachment',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
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
        $to = [
            'h.maeda0730@gmail.com'
            ];
        
        return $this->subject('Excel file attached')
                    ->attach($this->filePath)
                    ->view('emails.excel');
    }
}
