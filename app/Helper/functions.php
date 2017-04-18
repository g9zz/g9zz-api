<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/12
 * Time: 下午11:33
 */

/**
 * 将数组键值驼峰转下划线
 */
if (!function_exists('parse_input')) {
    function parse_input($array)
    {
        $newArr = [];
        foreach ($array as $key => $item) {
            $newArr[strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_', $key))] = $item ;
        }
        return $newArr;
    }
}

/**
 * 默认分页数
 */
if (!function_exists('per_page')) {
    function per_page($default = 20) {
        $limit = \FormRequest::get('limit');
        $limit = isset($limit) ? $limit : 20;
        return $default < $limit ? $default : $limit;
    }
}

if (!function_exists('hide_star')) {
    function hide_star() {

    }
}

/**
 * 时间格式转换
 */
if (! function_exists('rfc_3339')) {
    /**
     * format time to rfc3339
     *
     * @param $time
     * @return string
     */
    function rfc_3339($time)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->toRfc3339String();
    }
}

/**
 * 手机号 邮箱打星
 *
 * @param $str
 * @return mixed|null|string
 */
function hide_star($str)
{
    if (! $str) return '***';
    if (strpos($str, '@')) {
        $email_array = explode("@", $str);
        $prefix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀
        $count = 0;
        $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count);
        $rs = $prefix . $str;
    } else {
        $pattern = '/(1[0-9]{10})/i';
        if (preg_match($pattern, $str)) {
            $rs = substr_replace($str, '****', 3, 4);
        } else {
            $rs = mb_substr($str, 0, 1) . "**";
        }
    }
    return $rs;
}

function testTest() {
    echo '测试函数';
}