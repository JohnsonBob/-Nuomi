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
        //判断是否是post方式提交
        if(!$this->request->isPost()){
            $this->error('请求失败！');
        }
        //数据校验
        $data = input('post.');
//       dump($data);die();
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //$data['status'] = $status;
        if(!empty($data['id'])){
            $this->update($data);
        }
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

    /**
     * @param $data
     * 更新分类
     */
    public function update($data){
        if(empty($data) || !is_array($data)){
            $this->error('分类更新失败！');
        }
        if($this->objmodel->save($data,['id' => $data['id']])){
            $this->success('分类更新成功！');
        }
        $this->error('分类更新失败！');
    }
}
