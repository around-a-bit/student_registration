<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class, //Ensures that the application trusts certain proxies (like load balancers or reverse proxies), which is important when dealing with things like HTTPS headers or IP addresses.
        \Fruitcake\Cors\HandleCors::class, //Deals with Cross-Origin Resource Sharing (CORS), which allows or restricts requests from other domains.
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, //Prevents requests from being processed if the application is in maintenance mode (e.g., during updates).
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, //Ensures that any POST request that is too large is rejected.
        \App\Http\Middleware\TrimStrings::class, //Automatically trims any unnecessary spaces from request data.
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, //Converts any empty strings in request data to null, which helps to maintain consistent data types.
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class, //Checks if the user has the right permissions to perform a certain action.
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, //Redirects the user if they are already authenticated. 
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Applies rate-limiting to specific routes or actions to prevent abuse.
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'checkStudentLogin' => \App\Http\Middleware\CheckStudentLogin::class,
        'cors' => \Fruitcake\Cors\HandleCors::class,
    ];
}
