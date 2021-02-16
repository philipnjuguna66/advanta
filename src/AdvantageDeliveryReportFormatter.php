<?php


namespace PhilipNjuguna\Advanta;


use Carbon\Carbon;
use Symfony\Component\Dotenv\Dotenv;
use function Couchbase\defaultDecoder;

include_once("../vendor/autoload.php");

class AdvantageDeliveryReportFormatter
{
    public function setAttribute(array $results)
    {
        foreach ($results as $result) {
            $this->$result = $result;
        }
    }
}
