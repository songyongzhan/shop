<?php
/**
 * Created by PhpStorm.
 * User: songyongzhan
 * Date: 2019/2/26
 * Time: 11:03
 * Email: songyongzhan@qianbao.com
 */
import('Cart.php', 'library');

class FileCart extends Cart {


  /**
   *
   * @return mixed
   */
  public function getCartData() {
    // TODO: Implement getCartData() method.

  }


  /**
   * @param $goods
   * @return mixed
   */
  public function add($goods) {
    // TODO: Implement add() method.
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