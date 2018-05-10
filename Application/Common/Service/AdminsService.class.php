<?php 
/**
 * @author wenhao
 * 后台管理员
 */

namespace Common\Service;
use Common\Service\BaseService;
class AdminsService extends BaseService{
	
	// 虚拟模型
	protected $autoCheckFields =false;
    
    /**
     *  查询多个管理员
     */
    public function findAll($arrWhere){
        $result = M('admin')->where($arrWhere)->select();
        return $result;
    }
    
    /**
     *  查询一个管理员
     */
    public function findOne($arrWhere){
        $result = M('admin')->where($arrWhere)->find();
        return $result;
    }
    
    /**
     *  查询管理员数量
     */
    public function count($arrWhere){
        $result = M('admin')->where($arrWhere)->count();
        return $result;
    }
    
    /**
     *  编辑管理员
     */
    public function edit($arrWhere){
        $result = M('admin')->data($arrWhere)->save();
        return $result;
    }
    
    /**
     *  删除管理员
     */
    public function delete($arrWhere){
        $result = M('admin')->where($arrWhere)->delete();
        return $result;
    }
    
    /**
     *  新增管理员
     */
    public function add($arrWhere){
        $result = M('admin')->data($arrWhere)->add();
        return $result;
    }
    
}
?>