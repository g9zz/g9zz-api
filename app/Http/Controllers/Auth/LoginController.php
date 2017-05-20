<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        dd($request->all());
    }

    public function redirectToProvider(Request $request,$service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback(Request $request,$service)
    {
        $user = Socialite::driver($service)->stateless()->user();

        switch ($service)
        {
            case 'github':
                $this->loginByGithub($user);
                break;
            case 'weixin':
                $this->loginByWeixin($user);
                break;
            case 'weibo':
                $this->loginByWeibo($user);
                break;
            default:
                $this->loginByEmail();
                break;
        }

        return redirect()->route('admin.index');

    }

    public function loginByGithub($user)
    {
        if(!Users::where('github_id',$user->id)->first()){

            $create = [
                'github_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'avatar' => $user->avatar,
                'register_source' => 'github',
                'company' => $user->user['company'],
                'city' => $user->user['location'],
                'github_url' => $user->user['html_url'],
            ];

            $this->userRepository->create($create);
        }
        $userInstance = $this->userRepository->getUserByGithubId($user->id);
        \Auth::login($userInstance);

    }

    public function loginByWeixin($user)
    {

    }

    public function loginByWeibo($user)
    {

    }

    public function loginByEmail()
    {

    }
}
