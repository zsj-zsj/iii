<?php

//文件上传
function upload($file)
{
    if(request()->file($file)->isValid()){
        $img=request()->file($file);
        $imgimg=$img->store('images');
        return $imgimg;
    }
    exit('文件未上传或上传出错');
}
//递归掉父类
function getclassify($data , $parent_id=0 , $level=1)
{
    static $rongqi = [];
    if(!$data){
        return;
    }
    foreach($data as $k=>$v){
        if($v->parent_id == $parent_id){
            $v->level = $level;
            $rongqi[] = $v;
            getclassify($data , $v->cate_id , $level+1);
        }
    }
    return $rongqi;
}
//自己调自己
function getCateInfo($cateInfo,$parent_id=0)
{
    $info=[];
    foreach($cateInfo as $k=>$v){
        if($v['parent_id']==$parent_id){
            $son=getCateInfo($cateInfo,$v['cate_id']);
            $v['son']=$son;
            $info[]=$v;
        }
    }
    return $info;
}

function getCateId($cateinfo,$parent_id)
{
    static $c_id=[];
    $c_id[$parent_id]=$parent_id;
    foreach($cateinfo as $k=>$v){
        if($v['parent_id']==$parent_id){
            $c_id[$v['cate_id']]=$v['cate_id'];
            getCateId($cateinfo,$v['cate_id']);
        }
    }
    return $c_id;
}

//是否登录
function checkLogin()
{
    $user=session('user');
    return $user;
}
