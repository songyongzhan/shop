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
    $data = [
      'title' => $this->_post('title'),
      'sort_id' => $this->_post('sort_id', 999),
      'status' => $this->_post('status')
    ];
    $result = $this->goodsService->add($data);
    return $result;
  }

  /**
   * 栏目修改
   * @param string $title <POST> 栏目标题
   * @param int $pid <POST> 父级id
   * @param string $url <POST> 栏目url地址
   * @param int $platform_id <POST> 平台id
   * @param string $ext <POST> 扩展信息
   * @param string $relation_url <POST> 扩展url增加额外权限
   * @param int $type_id <POST> 栏目类型 默认 栏目1 方法名2
   * @return mixed 返回栏目信息
   */
  public function updateAction() {
    $id = $this->_post('id');
    $data = [
      'title' => $this->_post('title'),

      'status' => $this->_post('status')
    ];
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
      'username' => $this->_post('username'),

    ];
    /*  CREATE TABLE `shop_goods` (
     `id` bigint(8) NOT NULL AUTO_INCREMENT COMMENT '//商品ID',
   `category_id` int(4) NOT NULL COMMENT '//栏目ID',
   `title` varchar(80) NOT NULL COMMENT '//商品名称',
   `title_color` varchar(7) DEFAULT NULL COMMENT '//title颜色值',
   `description` varchar(200) NOT NULL COMMENT '//商品描述，推荐词',
   `cuxiaoyu` varchar(100) DEFAULT NULL COMMENT '//商品促销语',
   `keyword` varchar(255) DEFAULT NULL COMMENT '//商品关键字',
   `sn` varchar(50) NOT NULL COMMENT '//商品编号',
   `goodsattr` varchar(255) DEFAULT NULL COMMENT '//商品属性',
   `pricle` int(11) NOT NULL COMMENT '//售价 分',
   `jifen` int(10) NOT NULL COMMENT '//积分',
   `thumb` varchar(200) DEFAULT NULL COMMENT '//缩略图',
   `version` int(11) DEFAULT '0' COMMENT '//乐观锁版本控制',
   `body` text COMMENT '//商品详情',
   `sales` int(10) unsigned NOT NULL COMMENT '//销量',
   `is_activity` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '促销标记，0未促销，1促销，默认0',
   `activity_pricle` int(11) NOT NULL COMMENT '//促销价格 分',
   `weight` varchar(20) DEFAULT NULL COMMENT '//商品重量',
   `unit` int(4) DEFAULT NULL COMMENT '//商品单位',
   `stock_num` int(4) NOT NULL COMMENT '//商品库存',
   `bj_num` int(4) NOT NULL DEFAULT '0' COMMENT '//库存告警',
   `attr` varchar(50) DEFAULT NULL COMMENT '//商品是否推荐、热卖',
   `is_shangjia` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//是否上架',
   `is_mianyf` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//是否免除运费',
   `keywords` varchar(255) DEFAULT NULL COMMENT '//商品描述',
   `decoration` varchar(255) DEFAULT NULL COMMENT '//商品描述',
   `goods_photo` text COMMENT '//相册图片地址集合',
   `gl_goods` varchar(255) NOT NULL COMMENT '//关联商品',
   `clicks` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '//浏览次数',
   `last_operator` varchar(10) NOT NULL COMMENT '//最后修改者',
   `sort_id` int(8) NOT NULL DEFAULT '0' COMMENT '//排序',
   `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '//状态',
   `updatetime` int(10) DEFAULT '0' COMMENT '//更新时间',
   `createtime` int(10) DEFAULT '0' COMMENT '//创建时间',
   PRIMARY KEY (`id`),
   KEY `title` (`title`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8*/


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