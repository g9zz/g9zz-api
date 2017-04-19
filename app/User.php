<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $password
 * @property int $github_id
 * @property int $mobile
 * @property string $github_url
 * @property string $email
 * @property string $name
 * @property string $login_token
 * @property string $is_banned
 * @property string $image_url
 * @property int $topic_count
 * @property int $reply_count
 * @property int $follower_count
 * @property string $city
 * @property string $company
 * @property string $twitter_account
 * @property string $personal_website
 * @property string $introduction
 * @property string $certification
 * @property int $notification_count
 * @property string $github_name
 * @property string $real_name
 * @property string $linkedin
 * @property string $payment_qrcode
 * @property string $wechat_qrcode
 * @property string $avatar
 * @property string $login_qr
 * @property string $wechat_openid
 * @property string $wechat_unionid
 * @property string $weibo_name
 * @property string $weibo_link
 * @property bool $verified
 * @property string $verification_token
 * @property string $email_notify_enabled
 * @property string $register_source
 * @property string $last_actived_at
 * @property string $deleted_at
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCertification($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmailNotifyEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFollowerCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGithubId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGithubName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGithubUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIntroduction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastActivedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLinkedin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLoginQr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLoginToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNotificationCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePaymentQrcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePersonalWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRealName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRegisterSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTwitterAccount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVerificationToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWechatOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWechatQrcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWechatUnionid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWeiboLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWeiboName($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
