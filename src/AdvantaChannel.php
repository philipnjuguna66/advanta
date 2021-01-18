<?php


namespace PhilipNjuguna\Advanta;


use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Events\NotificationFailed;;
class AdvantaChannel
{


    /**
     * @var AdvantaSms
     */
    protected $advanta;

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * TwilioChannel constructor.
     *
     * @param AdvantaSms $advanta
     * @param Dispatcher $events
     */
    public function __construct(AdvantaSms $advanta, Dispatcher $events)
    {
        $this->advanta = $advanta;
        $this->events = $events;
    }
    public function send($notifiable, Notification $notification)
    {
        try {
            $to = $this->getTo($notifiable);
            $message = $notification->toAdvanta($notifiable);
            ;
            return $this->advanta->sendMessage($to, $message);

        } catch (Exception $exception) {
            $event = new NotificationFailed($notifiable, $notification, 'Advanta Message', ['message' => $exception->getMessage(), 'exception' => $exception]);
            if (function_exists('event')) { // Use event helper when possible to add Lumen support
                event($event);
            } else {
                $this->events->fire($event);
            }
        }
    }

    protected function getTo($notifiable)
    {

        if (isset($notifiable->phone_number)) {
            return $notifiable->phone_number;
        }

        
        throw new Exception("Could Not send message!! Invalid Receiver");
    }
}
