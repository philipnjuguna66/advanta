<?php


namespace PhilipNjuguna\Advanta;


use Carbon\Carbon;
use Symfony\Component\Dotenv\Dotenv;
use function Couchbase\defaultDecoder;

include_once("../vendor/autoload.php");

class AdvantaSMS
{

    /**
     * Define env method similar to laravel's
     *
     * @param String $env_param | Environment Param Name
     *
     * @return String
     */
    public static function env(string $env_param): string
    {

        $dotenv = new Dotenv();

        $dotenv->load('../.env');

        $env = getenv($env_param);

        return $env;
    }


    public function sendMessage($to, $message , $time  = null)
    {


        $url = 'https://quicksms.advantasms.com/api/services/sendsms/';


        $data = [
            'mobile' => "{$to}",
            'message' => "{$message}",
            'pass_type' => 'plain',
        ];

        if (! is_null($time))
        {
            $data[ "timeToSend"] = Carbon::parse($time)->format('Y-m-d H:i');
        }
        else{
            $data[ "timeToSend"] =  Carbon::now()->format('Y-m-d H:i');
        }



        $response = $this->sendRequest($data, $url);

        $count = 0;

        try {

            if ($response != null) {
                $responseData = json_decode($response, TRUE);
                foreach ($responseData as $responseItem) {

                    foreach ($responseItem as $smsdetails) {
                        $messageID = $responseData['responses'][$count]['messageid'];


                        $count++;
                    }
                }
            }
        }catch (\Exception $exception)
        {
            return true;
        }
    }


    public function getBalance()
    {
        $url = 'https://quicksms.advantasms.com/api/services/getbalance/';



        return $this->sendRequest([], $url);
    }

    public function getDelivery($messageId)
    {
        $url = 'https://quicksms.advantasms.com/api/services/getdlr/';

        $curlData = [
            'messageID' => $messageId,
        ];

        return  $this->sendRequest($curlData, $url);

    }

    public function sendRequest(array $curlData = [], string $url)
    {


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'partnerID' => env('ADVANTA_PARTNER_ID'),
            'apikey' => env('ADVANTA_API_KEY'),
            'shortcode' => env('ADVANTA_SHORT_CODE'),
        );




        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


        $curl_post_data = array_merge($curl_post_data, $curlData);


        $data_string = json_encode($curl_post_data);


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);


        return $curl_response;

    }
}
