<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Password;

class RegistrationSetupController extends Controller
{
    public function verifyEmail(User $user)
    {
        $this->ensureApproved($user);

        if (!$user->email_verified_at) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        return redirect(URL::temporarySignedRoute(
            'registration.password',
            now()->addHours(48),
            ['user' => $user->id]
        ))->with('status', 'Your email is verified. Please set your password to finish setup.');
    }

    public function showPasswordForm(User $user)
    {
        $this->ensureApproved($user);
        $this->ensurePasswordNotSet($user);

        return view('auth.registration-set-password', ['user' => $user]);
    }

    public function storePassword(Request $request, User $user)
    {
        $this->ensureApproved($user);
        $this->ensurePasswordNotSet($user);

        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user->forceFill([
            'password' => $validated['password'],
            'password_set_at' => now(),
            'email_verified_at' => $user->email_verified_at ?? now(),
            'is_active' => true,
        ])->save();

        return redirect()->route('login')->with('status', 'Your password is set. You can now log in.');
    }

    private function ensureApproved(User $user): void
    {
        if ($user->approval_status !== 'approved') {
            abort(403, 'This registration has not been approved.');
        }
    }

    private function ensurePasswordNotSet(User $user): void
    {
        if ($user->password_set_at) {
            abort(410, 'This password setup link has already been used.');
        }
    }
}
