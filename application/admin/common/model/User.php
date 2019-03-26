<?php
/**
 * Created by PhpStorm.
 * User: lzs592
 * Date: 2019/2/20
 * Time: 16:22
 */

namespace app\admin\common\model;
use think\Model;

class User extends Model
{
    protected $pk='id';
    protected $table='think_user';
    protected $autoWriteTimestamp=true;

}