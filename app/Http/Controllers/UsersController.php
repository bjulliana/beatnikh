<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UsersController extends Controller {

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show() {
		$user     = Auth::user();
		$products = Auth::user()->products()->with('images')->get();

		return view('auth.profile', compact('user', 'products'));
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id) {
		$user = Auth::user($id);

		return view('auth.edit', compact('user'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param                          $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function update(Request $request, $id) {

		$products = Auth::user()->products()->with('images')->get();
		$data      = request()->input();
		$validator = validator()->make(
			$data, [
				     'name'     => ['required', 'string', 'max:255'],
				     'email'    => ['required', 'string', 'email', 'max:255'],
				     'username' => ['required', 'string', 'max:30'],
				     'photo'    => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
			     ]
		);

		if ($validator->passes()) {
			$user           = Auth::user();
			$user->name     = $request->get('name');
			$user->email    = $request->get('email');
			$user->username = $request->get('username');

			if ($request->hasFile('photo')) {
				$photo    = $request->file('photo');
				$filename = time() . '.' . $photo->getClientOriginalExtension();
				Image::make($photo)->resize(
					300, null, function ($constraint) {
					$constraint->aspectRatio();
				}
				)->save(public_path('/uploads/users/' . $filename));
				$user->photo = $filename;
			}
			$user->save();

			return redirect(route('profile.show'))->with('success', 'Details Updated successfully!');
			}

		return back()->withErrors($validator->errors())->withInput()->with('error', 'Problem Updating Profile!');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function destroy($id) {
		$user       = User::find($id);
		$image_path = public_path() . '/uploads/users/' . $user->photo;
		File::delete($image_path);
		$user->delete();

		return redirect(route('home'));
	}
}
