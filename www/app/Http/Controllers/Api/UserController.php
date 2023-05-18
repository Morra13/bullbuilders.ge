<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /** @var string  */
    const ROUTE_UPDATE   = 'api.user.update';

    /** @var string  */
    const ROUTE_AVATAR   = 'api.user.avatar';

    /** @var string  */
    const ROUTE_ROLE     = 'api.user.role';

    /** @var string  */
    const ROUTE_PASSWORD = 'api.user.password';

    /**
     * Update user info
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $id = \auth()->user()->getAuthIdentifier();
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);

        $filePdfImg = storage_path('app/public/' . auth()->user()->pdf_img);

        if (!empty($request->file())){
            if (file_exists($filePdfImg)) {
                if (!empty(auth()->user()->pdf_img)) {
                    unlink(storage_path('app/public/' . auth()->user()->pdf_img));
                }
            }
            $fileName = time() . '_' . $request->file('input-pdf_img')->getClientOriginalName();
            $filePath = $request->file('input-pdf_img')->storeAs('/uploads', $fileName , 'public');
            auth()->user()->pdf_img = $filePath;
        }
        auth()->user()->update($request->all());
        auth()->user()->save();

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change password
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request)
    {
        $request->validate([
            'password'              => ['required', 'min:8', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        auth()->user()->password = bcrypt($request->get('password'));
        auth()->user()->save();

        return redirect()->back()->with('success', 'Password successfully changed!');
    }

    /**
     * Change role
     *
     * @param Request $request
     */
    public function role(Request $request)
    {
        $user = User::where('id', $request->get('user_id'))->first();
        $user->role = $request->get('role');
        $user->update();

        return back();
    }

    /**
     * Set avatar
     *
     * @param Request $request
     */
    public function avatar(Request $request)
    {
        $fileAvatar = storage_path('app/public/' . auth()->user()->avatar);

        if (file_exists($fileAvatar)) {
            if (!empty(auth()->user()->avatar) & auth()->user()->avatar != 'uploads/avatar_default.png'){
                unlink(storage_path('app/public/' . auth()->user()->avatar));
            }
        }

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('/uploads', $fileName , 'public');
        auth()->user()->avatar = $filePath;
        auth()->user()->save();

        return back()->withStatus(__('Avatar successfully updated.'));
    }
}
