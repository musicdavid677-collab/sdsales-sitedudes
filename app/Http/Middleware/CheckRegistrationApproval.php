<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationApproval
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            // Check if user is an administrator - bypass restriction
            if ($request->user()->is_administrator) {
                return $next($request);
            }

            // Check approval status
            if ($request->user()->approval_status !== 'approved') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Your registration is pending administrator approval.'
                    ], 403);
                }

                return redirect()->route('approval-pending')->with('error',
                    'Your registration is pending administrator approval. You will receive an email once your application is reviewed.');
            }

            // Check email verification
            if (!$request->user()->email_verified_at) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Please verify your email address.'
                    ], 403);
                }

                return redirect()->route('verification.notice')->with('error',
                    'Please verify your email address to continue.');
            }
        }

        return $next($request);
    }
}
