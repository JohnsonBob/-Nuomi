<?php
/**
 * Created by PhpStorm.
 * User: Johnson
 * Date: 2018/3/8
 * Time: 22:15
 */

namespace app\admin\validate;
use think\Validate;

/**
 * 验证器
*/
class Category extends Validate
{
    protected $rule = [
        'name'=>'require|max:10',
        'parent_id'=>'number',
        'id'=>'number',
        'status' => 'number|in:-1,0,1',
        'listorder' => 'number',
    ];

    protected $message  =   [
        'name.require' => '分类名不能为空',
        'name.max'     => '分类名不能超过十个字符',
        'parent_id.number'   => 'parent_id必须是数字',
        'id.number'    => 'id必须是数字',
        'status.number'    => '状态必须是数字',
        'status.in'    => '状态范围不合法',
        'listorder.number'    => '排序必须是数字',
    ];

    protected $scene = [
        'add' => ['name','parent_id','id'],
        'listorder' =>['id','listorder'],
    ];
}