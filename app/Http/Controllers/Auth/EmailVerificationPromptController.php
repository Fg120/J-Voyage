<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
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

        return view('auth.verify-email');
    }
}
