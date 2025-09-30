<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
//        try {

            $request->validate([
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'contact' => ['required', 'string', 'max:10', 'regex:/^0[0-9]{9}$/'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'status' => 1,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('customer');

            $customer = Customer::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'contact' => $request->contact,
                'email' => $request->email,
                'user_id' => $user->id,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Customer registered successfully!');
//        } catch (\Exception $exception) {
//            return back()->with('error', $exception->getMessage());
//        }
    }
}
