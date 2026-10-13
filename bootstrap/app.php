<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRegistrationApproval;
use App\Http\Middleware\EnsureAdministrator;
//use App\Http\Middleware\SetUserPermission;
//use App\Http\Middleware\CheckUserPermission;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
         $middleware->alias(['set_user_permission'=>SetUserPermission::class]);
         $middleware->alias(['administrator'=>EnsureAdministrator::class]);
         $middleware->alias(['registration.approved'=>CheckRegistrationApproval::class]);
 $middleware->alias(['perm'=>CheckUserPermission::class]);
 //$middleware->appendToGroup('web',SetUserPermission::class);
// $middleware->appendToGroup('web',CheckUserPermission::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
