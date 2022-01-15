<?php

namespace Fshangala\Cws;
use Illuminate\Support\ServiceProvider;

class CwsServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__."/../database/migrations");
  }
}
