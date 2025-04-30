<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['sometimes', 'string', 'in:student,organizer,admin'],
        ]);

        // By default, new users are students
        $role = 'student';
        
        // If the user is an admin, they can create users with different roles
        if (Auth::check() && Auth::user()->isAdmin() && $request->has('role')) {
            $role = $request->role;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        event(new Registered($user));

        // Only login if this is a self-registration
        if (!Auth::check()) {
            Auth::login($user);
        }

        // Redirect to different places based on the role
        if (Auth::check() && Auth::user()->isAdmin() && Auth::user()->id !== $user->id) {
            return redirect(route('admin.users', absolute: false))->with('success', 'User created successfully!');
        }

        return redirect(route('dashboard', absolute: false));
    }
    
    /**
     * Display the admin user creation view.
     */
    public function createByAdmin(): View
    {
        return view('auth.register-by-admin');
    }
}
