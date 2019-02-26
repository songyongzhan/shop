<?php
/**
 * Created by PhpStorm.
 * User: songyongzhan
 * Date: 2018/12/28
 * Time: 11:45
 * Email: 574482856@qq.com
 *
 */

defined('APP_PATH') OR exit('No direct script access allowed');

class GoodsService extends BaseService {

  const FIELD = ['id', 'title', 'pid', 'url', 'relation_url', 'ext', 'type_id', 'status', 'sort_id', 'updatetime', 'createtime'];

  /**
   * 获取栏目列表
   * @param array $where 搜索条件
   * @param int useType 用途 如果是1 显示栏目列表用于修改 ,不传值 或传0 用于左侧栏目显示
   */
  public function getList($where) {

    $result = $this->menuService->getList($where, self::FIELD);

    return $this->show($result);
  }

  /**
   * 获取单个栏目
   * @param int $id <require|number> 栏目id
   * @param string $field 获取栏目的信息
   * @return mixed
   */
  public function getOne($id, $field = self::FIELD) {
    $result = $this->menuService->getOne($id, $field);
    return $result ? $this->show($result) : $this->show([]);
  }


  /**
   * 删除商品
   * @param int $id <require> 栏目ids 多个栏目使用,分割
   * @return mixed
   */
  public function delete($id) {
    $result = $this->menuService->delete($id);
    return $result ? $this->show(['row' => $result, 'id' => $id]) : $this->show([], StatusCode::DATA_NOT_EXISTS);
  }


  /**
   * 批量排序
   * @param string $sortStr <require> 更新数据
   * @return array
   */
  public function batchSort($sortStr) {
    $sortData = explode('|', trim($sortStr, '|'));
    $data = [];
    foreach ($sortData as $key => $val) {
      list($id, $sortId) = explode(':', $val);
      $data[] = [
        'id' => $id,
        'sort_id' => $sortId
      ];
    }
    $result = $this->menuService->batchSort($data);
    return $this->show(['row' => $result]);
  }


}