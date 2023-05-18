<?php

namespace App\Notifications;

use App\Models\Instruction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class SuccessPayed
 * @package App\Notifications
 */
class SuccessPayed extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    private $_user;

    /**
     * @var Instruction
     */
    private $_instruction;

    /**
     * @var string
     */
    private $_file;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Instruction $instruction
     * @param string $file
     */
    public function __construct(User $user, Instruction $instruction, string $file)
    {
        $this->_user = $user;
        $this->_instruction = $instruction;
        $this->_file = $file;
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
        if (!empty($this->_instruction->main_img)) {
            $send = (new MailMessage)
                ->subject('Your payment was successful')
                ->line('Payment was processed successfully! Your pdf file with instructions in the attachment to the letter.')
                ->line(['![Creatory.Pro](https://creatory.pro/storage/' . $this->_instruction->main_img . ')'])
                ->attach('/var/www/storage/app/pdf/' . $this->_file, [
                    'as' => 'instruction.pdf',
                    'mime' => 'application/pdf',
                ])
                ->line('Thank you for using our application!');
        } else {
            $send = (new MailMessage)
                ->subject('Your payment was successful')
                ->line('Payment was processed successfully! Your pdf file with instructions in the attachment to the letter.')
                ->attach('/var/www/storage/app/pdf/' . $this->_file, [
                    'as' => 'instruction.pdf',
                    'mime' => 'application/pdf',
                ])
                ->line('Thank you for using our application!');
        }

        return $send;
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
