<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Auth;
use Session;
use Redirect;

class UloginController extends Controller
{
	public function loginAction(Request $request)
	{
		// Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, TRUE);

        $network = $user['network'];

        // Find user in DB.
        $userData = User::where(['uid' => $user['uid'], 'network' => $network])->first();

        if (isset($userData->id)) {
        	// Make login user.
            Auth::loginUsingId($userData->id, TRUE);
            Session::flash('flash_message', trans('interface.ActivatedSuccess'));
        } else {
			$newUser = new User();
			$newUser->name = $user['first_name'] . ' ' . $user['last_name'];
			$newUser->password = bcrypt($user['uid']);
	        $newUser->first_name = $user['first_name'];
            $newUser->last_name = $user['last_name'];
            $newUser->uid = $user['uid'];
            $newUser->network = $user['network'];
            $newUser->save();

	        // Make login user.
            Auth::loginUsingId($newUser->id, TRUE);

            Session::flash('flash_message', trans('interface.ActivatedSuccess'));
        }

        return Redirect::back();
	}
}