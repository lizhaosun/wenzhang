<?php


namespace app\common\model;
use think\Model;

class PingLun extends Model
{
    protected $pk='id';
    protected $table='think_pinglun';
    protected $autoWriteTimestamp=true;//自动时间戳
    protected $createTime='create_time';
    Protected $updateTime='update_time';
    protected $dateFormat='Y年m月d日';

    //开启自动设置
    protected $auto=[];//无论是新增或者更新都要设置的字段
    //仅新增的有效
    protected $insert=['create_time','status'=>1];
    //仅更新时设置
    protected $update=['update_time'];


}