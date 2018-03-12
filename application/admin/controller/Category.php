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
        if($data){
            var_dump($data);die();
        }
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

    /**
     *编辑界面
     */
    public function edit(){
        //intval获取变量的整数值，允许以使用特定的进制返回。默认10进制
        if(intval(input('id'))<1){
            $this->error('参数不合法');
        }
        //当前要编辑对象
        $categoryValue = $this->objmodel->get(input('id'));
        //获取所有一级栏目
        $categorys= $this->objmodel->getNormalFirstCategory();
        $this->assign([
            'categorys'=>$categorys,
            'categoryValue' => $categoryValue,
        ]);
        return $this->fetch();
    }
}
