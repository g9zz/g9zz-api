<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/21
 * Time: 上午12:28
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Services\Auth\UserService;
use App\Transformers\UserTransformer;
use Hashids\Hashids;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use League\Fractal\Resource\Item;


class MyRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $userService;

    protected $hashids;

    protected $isInvite;

    public function __construct(UserService $userService,
                                Hashids $hashids)
    {
        $this->middleware('guest');
        $this->userService = $userService;
        $this->hashids = $hashids;
        $this->isInvite = config('g9zz.invite_code.is_invite');

    }

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rule = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
        if ($this->isInvite) {
            $rule['inviteCode'] = 'required|exists:invite_code,code,status,created';
        }

        return $this->requestValidate($data,$rule,'register');
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        //需要邀请码
        //不需要邀请码 直接注册
        $other = [];
        if ($this->isInvite) {
            $other['invite_code'] = $data['inviteCode'];
        }

        $create = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ];
        return  $this->userService->loginCreate($create,$other);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $resource = new Item($user,new UserTransformer());
        $this->setData($resource);
        return $this->response();
    }

}