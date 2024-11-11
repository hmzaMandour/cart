<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
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
            'role.*' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $user->roles()->attach($request->role);
        
        Auth::login($user);


        return redirect(route('dashboard', absolute: false));
    }


    public function changeuser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $moderatorRole = Role::where('name', 'moderator')->first();
        $userRole = Role::where('name', 'client')->first();

        if ($request->has('role') && $request->role == $moderatorRole->id) {
            $user->roles()->sync([$moderatorRole->id]);
            return back();
        } else {
            $user->roles()->sync([$userRole->id]);
            return back();
        }

        return back()->with('success', 'User role updated successfully.');
    }




    
}
