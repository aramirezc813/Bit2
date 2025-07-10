<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CorreoElectronico extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Envío de Credenciales - Sistema Bit2";

    public $datos;

    /**
     * Create a new message instance.
     */
    public function __construct($request){
        $this->datos = $request;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envío de Credenciales - Sistema Bit2',
           /*  cc: [ 'ati.svc@edomex.gob.mx',  'gonzalezvaldesjaneth@gmail.com'], // Copia a otros usuarios */
            bcc: ['aramirezc813@gmail.com'], // Copia oculta a otros usuarios
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
      /*   return $this->view('correo.credenciales'); */
        return $this->markdown('correo.bienvenido_md');

    }
}
