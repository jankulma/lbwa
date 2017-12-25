<?php namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

class SettingsController extends BackendController
{
    public function index()
    {
        return view('backend.settings.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'item' => 'required|string'
        ]);

        $storeItem = $request->get('item');

        return $this->$storeItem($request);
    }

    private function storeUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        if (! $user) {
            return response()->json([
                'message' => 'Problem occured when saving new user.'
            ], 422);
        }

        return response()->json([
            'message' => "New user {$user->email} has been added!",
        ]);
    }

    public function update(Request $request, $setting)
    {
        return $this->$setting($request);
    }

    private function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        $validatePassword = $this->validatePassword($user, $request->get('current_password'));

        if (! $validatePassword) {
            return response()->json([
                'message' => 'Current password is not valid.'
            ], 422);
        }

        $user->updatePassword($request->get('new_password'));

        return response()->json([
            'message' => 'Password has been changed!',
        ]);
    }

    private function updateEmail(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'new_email' => 'required|email',
        ]);

        $user = auth()->user();

        $validatePassword = $this->validatePassword($user, $request->get('password'));

        if (! $validatePassword) {
            return response()->json([
                'message' => 'Password is not valid.'
            ], 422);
        }

        $user->updateEmail($request->get('new_email'));

        return response()->json([
            'message' => 'E-mail has been changed!',
            'newEmail' => $request->get('new_email')
        ]);
    }

    private function validatePassword(User $user, $password)
    {
        return auth()->validate([
            'email' => $user->email,
            'password' => $password
        ]);
    }
}
