<?php
namespace app\common\model;
use think\Model;

class Cate extends Model
{
    protected $pk='id';
    protected $table='think_article_category';
    protected $autoWriteTimestamp=true;

}