<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RechazoAsignacionMail extends Mailable
{
       use Queueable, SerializesModels;

    public $motivo;
    public $datos;

    public function __construct($motivo, $datos)
    {
        $this->motivo = $motivo;
        $this->datos = $datos;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rechazo de Propuesta de Asignación  - Sistema Bit2',
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
        return $this->markdown('correo.rechazo_md')
                    ->subject('Rechazo de Propuesta de Asignación')
                    ->with([
                        'motivo' => $this->motivo,
                        'datos' => $this->datos,
                    ]);
    }
}

