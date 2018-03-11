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
        if(input('parent_id')){
            $categorys = $this->objmodel->getFirstCategory(input('parent_id'));
        }else{
            $categorys = $this->objmodel->getFirstCategory();
        }
        $this->assign('categorys',$categorys);
        return $this->fetch();
    }
    public function add()
    {
        $categorys= $this->objmodel->getNormalFirstCategory();
        //var_dump($categorys);die();
        $this->assign('categorys',$categorys);
        return $this->fetch();
    }

    public function save()
    {
        $data = input('post.');
//       dump($data);die();
        //数据校验
        $validate = validate('Category');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }
        $data['status'] = 1;
        if($this->objmodel->addClassification($data)){
            $this->success('生活服务类添加成功');
        }else{

            $this->error('生活服务类添加失败');
        }
        return;
    }

}
