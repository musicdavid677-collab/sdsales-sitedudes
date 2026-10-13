<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationApproval
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Accounts created before the approval workflow have no registration record and are not gated.
        if (!$user || $user->is_administrator || !$user->registrationApproval) {
            return $next($request);
        }

        if ($user->approval_status !== 'approved') {
            $message = $user->approval_status === 'rejected'
                ? 'Your registration was not approved.'
                : 'Your registration is pending administrator approval.';

            return $this->deny($request, $message);
        }

        if (!$user->email_verified_at) {
            return $this->deny($request, 'Please verify your email address to continue.');
        }

        return $next($request);
    }

    private function deny(Request $request, string $message): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 403);
        }

        return redirect()->route('approval-pending')->with('error', $message);
    }
}
