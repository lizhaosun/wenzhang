<?php
/**
 * think_user表的验证器
 */

namespace app\common\validate;
use think\Validate;

class User extends Validate
{
    protected $rule=[
        'name|姓名'=> 'require',
        'email|邮箱'=> 'require|email|unique:think_user',
        'mobile|手机号'=>'require|mobile|unique:think_user',
        'password|密码'=>'require|length:6,20|alphaNum|confirm'
    ];

}

       /* 'name|名字'=>[
            'require'=>'require',
            'length'=>'5,20',
            'chsAlphaNum'=>'chsAlphaNum', //仅允许汉子字母与数字
        ],
        'email|邮箱'=>[
            'require'=>'require',
            'email'=>'email',
            'unique'=>'think_user', //该字段必须在think_user表中唯一的

        ],
        'mobile|手机'=>[
            'require'=>'require',
            'mobile'=>'mobile',
            'unique'=>'think_user', //该字段必须在think_user表中唯一的
            'number'=>'number',
        ],
        'password|密码'=>[
            'require'=>'require',
            'length'=>'6,20',
            'AlphaNum'=>'AlphaNum', //仅允许字母与数字
            'confirm'=>'confirm',//自动与password_confirm'字段进行自动相等校验
        ]*/

