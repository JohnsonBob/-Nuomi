<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/9
 * Time: 9:30
 */

namespace app\admin\model;
use think\Model;

class Category extends Model
{
    /**
     *分类管理--添加生活服务分类
     */
    public function addClassification($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
        if($this->save($data)){
            return true;
        }
        return false;
    }

    /**
     *获取一级分类
     */
    public function getNormalFirstCategory(){
        $data = [
            'parent_id' => 0,
            'status' =>1,
        ];
        //dump($data);die();
        $order = [
            'id' => 'desc',
        ];
        $result = $this->where($data)->order($order)->select();
        //echo $this->getLastSql();
        return $result;
    }

    public function getFirstCategory(){
        $data = [
            'parent_id' => 0,
            'status' =>['status','neq',-1],
        ];
        //dump($data);die();
        $order = [
            'id' => 'desc',
        ];
        $result = $this->where($data)->order($order)->select();
        echo $this->getLastSql();
        return $result;
    }
}