<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/21
 * Time: 上午11:21
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ConsoleLoginRequest;
use App\Services\Auth\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use League\Fractal\Resource\Item;
use Vinkla\Hashids\Facades\Hashids;

class MyLoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $isInvite;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->isInvite = config('g9zz.invite_code.is_invite');
        $this->userService = $userService;
    }

    /**
     * @param ConsoleLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(ConsoleLoginRequest $request)
    {
        $email = $request->get('email');
        $user = $this->userService->findUserByEmail($email);
        $requestPwd = $request->get('password');

        $this->userService->checkPwd($requestPwd,$user->password);

        $now = time();
        $auth = [$user->id, $now];
        return $this->makeToken($auth);
    }

    public function makeToken($auth)
    {
        $token = Hashids::connection('console_token')->encode($auth);
        $data = new \stdClass();
        $data->token = $token;
        $this->setData($data);
        $this->setCode(200);
        return $this->response();
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
        $isGithub = $this->userService->checkIsGithub($user->id);

        if ($this->isInvite) {

        }



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