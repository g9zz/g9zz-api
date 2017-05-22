<?php

namespace App\Http\Middleware;

use App\Services\Auth\UserService;
use App\Traits\G9zzLog;
use App\Traits\Respond;
use Closure;
use Vinkla\Hashids\Facades\Hashids;

class Ylsc
{

    use Respond,G9zzLog;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ylsc =  $request->header('authorization');
        $this->log('header.request to '.__METHOD__,['authorization' => $ylsc]);
        if (empty($ylsc)) {
            $code = config('validation.validation.token')['token.isNull'];
            return $this->handleRes($code);
        }

        $token = Hashids::connection('index_token')->decode($ylsc);
        if (empty($token) || !is_array($token) || count($token) < 2) {
            $code = config('validation.validation.token')['token.invalid'];
            return $this->handleRes($code);
        }

        $id = $token[1];
        $user = $this->userService->findUserByToken($id);
        if (empty($user)) {
            $code = config('validation.validation.token')['token.invalid'];
            return $this->handleRes($code);
        }

        $now = time();
        $beginTime = $token[0];
        $limitTime = config('g9zz.token.valid_time');
        if ($now - $beginTime > $limitTime) {
            $code = config('validation.validation.token')['token.invalid'];
            return $this->handleRes($code);
        }

        $request->offsetSet('ylsc_user_id',$user->id);
        $request->offsetSet('ylsc_user_hid',$user->hid);

        return $next($request);
    }

    public function handleRes($code)
    {
        $this->log('error.request to '.__METHOD__,['code' => $code]);
        $this->setCode($code);
        return $this->response();
    }
}
