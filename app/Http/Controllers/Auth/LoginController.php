<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirection après login selon le rôle.
     * Remplace redirectTo() par authenticated().
     */
    protected function authenticated(Request $request, $user)
        {
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.index');
            }

            if ($user->hasRole('employe')) {
                return redirect()->route('employe.bienvenue');
            }

            if ($user->hasRole('comptable')) {
                return redirect()->route('admin.index');
            }

            if ($user->hasRole('rh')) {
                return redirect()->route('admin.index');
            }

            // Aucun rôle assigné
            Auth::logout();
            return redirect()->route('login')->with('error', 'Aucun rôle assigné, contactez l’administrateur.');
        }

    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirection vers login pour éviter le 404 sur /
            return redirect()->route('login');
        }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
