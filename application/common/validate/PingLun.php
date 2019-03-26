<?php
/**
 * think_user表的验证器
 */

namespace app\common\validate;
use think\Validate;

class PingLun extends Validate
{
    protected $rule=[
        'content|评论内容'=>'require|length:5,10000',
    ];

}