<?php
/**
 * Created by PhpStorm.
 * User: songyongzhan
 * Date: 2019/2/26
 * Time: 11:03
 * Email: songyongzhan@qianbao.com
 */
import('Cart.php', 'library');

class DbCart extends Cart {

  /**
   * @var MysqliDb
   */
  private $_db;

  /**
   * @var string
   */
  private $prefix = '';

  public function getDbInstace() {
    $this->_db = Yaf_Registry::has('db') ? Yaf_Registry::get('db') : NULL;

    if (!$this->_db) {
      throw new Exception('数据库连接不存在!');
    }
    $this->prefix = Tools_Config::getConfig('db.mysql.prefix');
  }

  public function __construct($expire = 604800) {
    parent::__construct($expire);
    $this->getDbInstace();
  }

  /**
   *
   * @return mixed
   */
  public function getCartData() {
    // TODO: Implement getCartData() method.
    //如果是登录状态，则查询数据库
  }


  /**
   * @param $goods
   * @return mixed
   */
  public function add($goods) {
    // TODO: Implement add() method.

    //return setCookie("cart[{$_product['id']}]", serialize($_product), time() + $this->expire);


  }

  /**
   * 通过id删除商品
   * @param $id
   * @return mixed
   */
  public function del($id) {
    // TODO: Implement del() method.
  }

  /**
   * 清空购物车
   * @return mixed
   */
  public function clearCart() {
    // TODO: Implement clearCart() method.
  }

  /**
   * 更新商品数量及属性
   * @param $goods
   * @return mixed
   */
  public function update($goods) {
    // TODO: Implement update() method.
  }

  /**
   * 获取购物车中商品的总数量
   * @return mixed
   */
  public function cartGoodsTotalNumbers() {
    // TODO: Implement cartGoodsTotalNumbers() method.
  }
}