<?php
/**
 * Created by PhpStorm.
 * User: lzs592
 * Date: 2019/2/15
 * Time: 15:46
 */

namespace app\common\model;
use think\Model;

class Article extends Model
{
    protected $pk='id';
    protected $table='think_article';

    protected $autoWriteTimestamp=true;//自动时间戳
    protected $createTime='create_time';
    Protected $updateTime='update_time';
    protected $dateFormat='Y年m月d日';

    //开启自动设置
    protected $auto=[];//无论是新增或者更新都要设置的字段
    //仅新增的有效
    protected $insert=['create_time','status'=>1,'is_top'=>0,'is_hot'=>0];
    //仅更新时设置
    protected $update=['update_time'];



}