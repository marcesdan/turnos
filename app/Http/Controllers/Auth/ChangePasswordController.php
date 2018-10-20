<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()
                ->back()
                ->with("error", "Tu contraseña no coincide con la que ingresaste. Por favor, intentá de nuevo.");
        }
        if (strcmp($request->get('password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return redirect()
                ->back()
                ->with("error", "La nueva contraseña no puede ser igual a la contraseña actual. Por favor, elegí otra contraseña.");
        }
        $validatedData = $request->validate([
            'password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect('/')->with('status', 'Contraseña cambiada con éxito!');
    }

}
