<?php
namespace app\admin\controller;
use think\Controller;

class Category extends Base
{
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
        $validate = validate('Category');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }
    }

}
