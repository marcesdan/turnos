<?php

namespace App\Notifications;

use App\Turno;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class SolicitudNotification extends Notification
{
    use Queueable;

    protected $turno;

    /**
     * SolicitudNotification constructor.
     * @param $turno
     */
    public function __construct(Turno $turno)
    {
        $this->turno = $turno;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute('solicitud.confirmar', now()->addHours(12), [
            'turno' => $this->turno->id,
            'paciente' => $notifiable->id,
        ]);
        return (new MailMessage)
                    ->greeting('Hola, '.$notifiable->nombre)
                    ->subject('Confirmación de reserva')
                    ->line('Estás recibiendo este email porque solicitaste reservar un turno')
                    ->action('Reservar turno', $url)
                    ->line('Si no solicitaste reservar un turno, podés ignorar o eliminar este mail.');
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
