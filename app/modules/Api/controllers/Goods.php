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

class GoodsController extends ApiBaseController {


  /**
   * 获取商品列表
   * @name 列表
   * @return mixed
   */
  public function getListAction() {
    $where = [];

    $result = $this->goodsService->getList($where);
    return $result;
  }

  /**
   * 商品添加
   * @param string $title <POST> 标题
   * @return mixed 返回栏目信息
   */
  public function addAction() {
    $data = $this->_params();
    $result = $this->goodsService->add($data);
    return $result;
  }

  /**
   * 栏目修改
   * @param string $title <POST> 栏目标题
   * @param int $pid <POST> 父级id
   * @return mixed 返回栏目信息
   */
  public function updateAction() {
    $id = $this->_post('id');
    $data = $this->_params();
    $result = $this->goodsService->update($id, $data);
    return $result;
  }

  /**
   * 获取单个栏目
   * @name 获取栏目
   * @param int $id <POST> 栏目id
   * @return mixed 返回栏目信息
   */
  public function getOneAction() {
    $id = $this->_post('id');
    $result = $this->goodsService->getOne($id);
    return $result;
  }

  /**
   * 删除栏目
   * @name 删除
   * @param int $id <POST> 栏目id
   * @return mixed
   */
  public function deleteAction() {
    $id = $this->_post('id');
    $result = $this->goodsService->delete($id);
    return $result;
  }

  /**
   * 批量排序
   * @name 批量排序
   * @param string $sortStr <POST> 更新数据
   * @return mixed
   */
  public function batchSortAction() {
    $sortStr = $this->_post('sort_str');
    $result = $this->goodsService->batchSort($sortStr);
    return $result;
  }


  /**
   * 从post请求中获取
   * @return array
   */
  private function _params() {
    return [
      'category_id' => $this->_post('category_id'),
      'title' => $this->_post('title'),
      'title_color' => $this->_post('title_color'),
      'description' => $this->_post('description'),
      'cuxiaoyu' => $this->_post('cuxiaoyu'),
      'sn' => $this->_post('sn'),
      'goodsattr' => $this->_post('goodsattr'),
      'pricle' => $this->_post('pricle'),
      'jifen' => $this->_post('jifen'),
      'thumb' => $this->_post('thumb'),
      'version' => $this->_post('version'),
      'body' => $this->_post('body'),
      'is_activity' => $this->_post('is_activity'),
      'activity_pricle' => $this->_post('activity_pricle'),
      'weight' => $this->_post('weight'),
      'unit' => $this->_post('unit'),
      'stock_num' => $this->_post('stock_num'),
      'attr' => $this->_post('attr'),
      'is_shangjia' => $this->_post('is_shangjia'),
      'is_mianyf' => $this->_post('is_mianyf'),
      'keywords' => $this->_post('keywords'),
      'goods_photo' => $this->_post('goods_photo'),
      'sort_id' => $this->_post('sort_id'),
      'status' => $this->_post('status')
    ];
  }

  /**
   * 公共搜索条件
   * @return array|bool|mixed
   */
  private function _search() {

    $category_id = $this->_post('category_id', '');
    $title = $this->_post('title', '');
    $sn = $this->_post('sn', '');

    $rules = [
      ['condition' => 'like',
        'key_field' => ['title'],
        'db_field' => ['title']
      ],
      [
        'condition' => '=',
        'key_field' => ['category_id', 'sn'],
        'db_field' => ['category_id', 'sn']
      ]
    ];

    $data = [
      'category_id' => $category_id,
      'title' => $title,
      'sn' => $sn
    ];

    $where = $this->where($rules, array_filter($data, 'filter_empty_callback'));

    return $where;

  }


}