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
    ];

    protected $message  =   [
        'name.require' => '分类名不能为空',
        'name.max'     => '分类名不能超过十个字符',
    ];
}