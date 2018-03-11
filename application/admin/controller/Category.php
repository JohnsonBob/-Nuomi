<?php
namespace app\admin\controller;
use think\Controller;
use think\Model;

class Category extends Base
{
    private  $objmodel;
    public function initialize(){
        $this->objmodel = model('Category');
    }
    public function index()
    {
        return $this->fetch();
    }
    public function add()
    {
        return $this->fetch();
    }

    public function save()
    {
        $data = input('post.');
//        dump($data);die();
        //数据校验
        $validate = validate('Category');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }
        if($this->objmodel->addClassification($data)){
            $this->success('生活服务类添加成功');
        }else{

            $this->error('生活服务类添加失败');
        }
        return;
    }

}
