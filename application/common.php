<?php
use think\Db;
//根据用户的主键id,查询用户名称
if(!function_exists('getUserName')){
function getUserName($id){
   return Db::table('think_user')->where('id',$id)->value('name');
}
}
if(!function_exists('getArtContent')){
    function getArtContent($content){
        return mb_substr(strip_tags($content),0,5).'...';
    }
}
if(!function_exists('getCateName')){

}    function getCateName($cateId){
        return Db::table('think_article_category')->where('id',$cateId)->value('name');
    }
