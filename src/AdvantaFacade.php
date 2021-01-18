<?php
namespace PhilipNjuguna\Advanta;

use Illuminate\Support\Facades\Facade;

class AdvantaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Advanta';
    }

}
