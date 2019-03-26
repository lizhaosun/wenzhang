<?php
namespace app\admin\common\model;
use think\Model;

class Site extends Model
{
    protected $pk='id';
    protected $table='think_site';
    protected $autoWriteTimestamp=true;

}