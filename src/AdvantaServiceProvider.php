<?php


namespace PhilipNjuguna\Advanta;


use Illuminate\Support\ServiceProvider;

class AdvantaServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind('advanta', function (){
            return new AdvantaSms();
        });


    }

    public function boot()
    {
        $this->app->when(AdvantaChannel::class)
            ->needs(AdvantaSms::class);
    }

}
