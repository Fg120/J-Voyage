<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $user = $request->user();
            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            } elseif ($user->hasRole('pengelola')) {
                return redirect()->intended(route('pengelola.dashboard', absolute: false));
            }
            return redirect()->intended(route('onboarding', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
