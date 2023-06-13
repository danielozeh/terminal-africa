<?php
namespace DanielOzeh\TerminalAfrica;

use Illuminate\Support\ServiceProvider;
use DanielOzeh\TerminalAfrica;

class TerminalAfricaCoreServiceProvider extends ServiceProvider
{
    public function register() {
        $this->mergeConfigFrom(__DIR__.'/../config/terminal_africa.php', 'terminal_africa');
        $this->app->bind(TerminalAfrica::class);
    }


    public function boot()
    {
        
    }

}