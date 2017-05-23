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
use Laravel\Socialite\Facades\Socialite;
use Vinkla\Hashids\Facades\Hashids;

class MyLoginController extends Controller
{

//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';
    protected $isInvite;
    protected $userService;

    public function __construct(UserService $userService)
    {
//        $this->middleware('guest', ['except' => 'logout']);
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
        //防止三方登录,密码为空的情况
        if (empty($user->password)) {
            $this->setCode(config('validation.validation.login')['login.error']);
            return $this->response();
        }

        $requestPwd = $request->get('password');
        $this->userService->checkPwd($requestPwd,$user->password);

        $now = time();
        $auth = [$user->id, $now];
        return $this->makeToken($auth);
    }

    /**
     * @param $auth
     * @return \Illuminate\Http\JsonResponse
     */
    public function makeToken($auth)
    {
        $token = Hashids::connection('console_token')->encode($auth);
        $data = new \stdClass();
        $data->token = $token;
        $this->setData($data);
        $this->setCode(200);
        return $this->response();
    }

    /**
     * @param Request $request
     * @param $service
     * @return mixed
     */
    public function redirectToProvider(Request $request,$service)
    {
        if (!in_array($service,config('g9zz.token.login_way'))) {
            $this->setCode(config('validation.validation.default')['some.error']);
            return $this->response();
        }

        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback(Request $request,$service)
    {
        $user = Socialite::driver($service)->stateless()->user();

        switch ($service)
        {
            case 'github':
                return $this->loginByGithub($user);
                break;
            case 'weixin':
                return $this->loginByWeixin($user);
                break;
            case 'weibo':
               return $this->loginByWeibo($user);
                break;
            default:
                return $this->loginByEmail();
                break;
        }

    }

    public function loginByGithub($user)
    {
        $isGithub = $this->userService->checkIsGithub($user->id);
        //第一次授权
        if (empty($isGithub)) {
            if ($this->isInvite) {
                $this->setCode(config('validation.validation.register')['needInvite.notSocialite']);
                return $this->response();
            }

            $result = $this->userService->storeGithub($user);
        } else {
            $result = $this->userService->findUserByGithubId($isGithub->id);
            if (empty($result)) {
                $this->setCode(config('validation.validation.default')['some.error']);
                return $this->response();
            }
        }

        $now = time();
        $auth = [$result->id, $now];
        return $this->makeToken($auth);

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