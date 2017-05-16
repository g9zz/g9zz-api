<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/4/12
 * Time: 下午6:01
 */

return [
    //default
    0 => '成功',

    400000000 => '有点不正常，请稍后再试',
    400000001 => '数据不存在,请检查后再试',

    //post
    401000000 => '请输入帖子标题',
    401000001 => '帖子标题过长,请检查后再试',
    401000002 => '请输入帖子内容',

    //node
    402000000 => '请输入父节点ID',
    402000001 => '请输入权重',
    402000002 => '请输入节点别名',
    402000003 => '请输入节点名称',
    402000004 => '节点别名已存在,请检查后再试',
    402000005 => '节点名称已存在,请检查后再试',
    402000006 => '节点名称格式不正确,请检查后再试',
    402000007 => '节点名称过长,请检查后再试',
    402000008 => '节点level级别过高,请检查后再试',
    402000009 => '父节点设置有逻辑错误,请检查后再试',
    402000010 => '该节点下还有子节点,不允许删除,请检查后再试',

    //tag
    403000000 => '请输入标签名',
    403000001 => '标签名已存在,请检查后再试',
    403000002 => '请输入别名',
    403000003 => '别名已存在,请检查后再试',
    403000004 => '别名字数过长,请检查后再试',
    403000005 => '别名格式不正确,请检查后再试',
    403000006 => '请输入标签权重',
    403000007 => '标签描述过长,请检查后再试',

    //reply
    405000000 => '请传入帖子ID',
    405000001 => '该帖子不存在,请检查后再试',
    405000002 => '回复内容不能为空,请检查后再试',

    //append
    406000000 => '请输入附言内容',
    406000001 => '附言内容过长,请检查后再试',
    406000002 => '请输入帖子ID',
    406000003 => '帖子ID不存在,请检查后再试',
    406000004 => '只有原帖作者才能添加,请检查后再试',
    406000005 => '该帖已超过最大附言数,请检查后再试',
];