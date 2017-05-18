<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午5:04
 */

namespace App\Providers;


use App\Repositories\Contracts\AppendRepositoryInterface;
use App\Repositories\Contracts\NodeRepositoryInterface;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\AppendRepository;
use App\Repositories\Eloquent\NodeRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\ReplyRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\TagRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
        $this->app->bind(NodeRepositoryInterface::class,NodeRepository::class);
        $this->app->bind(TagRepositoryInterface::class,TagRepository::class);
        $this->app->bind(ReplyRepositoryInterface::class,ReplyRepository::class);
        $this->app->bind(AppendRepositoryInterface::class,AppendRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
    }
}