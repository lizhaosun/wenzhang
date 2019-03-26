<?php
/**
 * Created by PhpStorm.
 * User: lzs592
 * Date: 2019/2/15
 * Time: 15:53
 */

namespace app\common\validate;
use think\Validate;

class ArtCate extends Validate
{
    protected $rule=[
        'name|标题'=>'require|length:3,20|chsAlpha',

    ];
}