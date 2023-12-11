<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\Passport\Client;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // https://laravel.com/docs/10.x/passport#client-secret-hashing
        // Passport::hashClientSecrets();

        // https://laravel.com/docs/10.x/passport#token-lifetimes
        Passport::tokensExpireIn(now()->addDays(1));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        // https://laravel.com/docs/10.x/passport#overriding-default-models
        // https://laravel.com/docs/10.x/passport#approving-the-request
        Passport::useClientModel(Client::class);

        // https://laravel.com/docs/10.x/passport#defining-scopes
        Passport::tokensCan([
            'place-orders' => 'Place orders',
            'check-status' => 'Check order status',
            'view-user' => 'View user information'
        ]);

        // https://laravel.com/docs/10.x/passport#default-scope
        // Passport::setDefaultScope([
        //     'check-status',
        //     'place-orders',
        //     'view-user'
        // ]);
    }
}
