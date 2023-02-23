<?php

namespace App\Providers;

use App\Services\AccountService;
use App\Services\BankService;
use App\Services\DepositService;
use App\Services\TransactionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AccountService::class, function ($app) {
            return new AccountService();
        });
        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionService();
        });
        $this->app->bind(DepositService::class, function ($app) {
            return new DepositService($app->make(TransactionService::class), $app->make(AccountService::class));
        });
        $this->app->bind(BankService::class, function ($app) {
            return new BankService($app->make(DepositService::class));
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
