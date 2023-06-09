<?php
namespace DanielOzeh\TerminalAfrica;

use Illuminate\Support\ServiceProvider;

class TerminalAfricaCoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/api.php');
        $this->loadRoutesFrom(__DIR__.'/web.php');
    }

}