<?php
/**
 * Created by PhpStorm.
 * User: lzs592
 * Date: 2019/2/15
 * Time: 15:53
 */

namespace app\common\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule=[
        'title|标题'=>'require|length:5,50',
        'title_img|图片'=>'size:209715200|ext:jpeg,jpg,png,gif',
        'content|文章内容'=>'require|length:5,10000',
        'user_id|作者'=>'require',
        'cate_id|栏目名称'=>'require'
    ];
}
