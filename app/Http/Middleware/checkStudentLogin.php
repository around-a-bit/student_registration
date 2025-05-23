<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckStudentLogin
{
    public function handle(Request $request, Closure $next)
    {
        // If student is not logged in, redirect to the login page
        if (!Session::has('student_id')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
