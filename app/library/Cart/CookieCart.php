<?php
/**
 * Created by PhpStorm.
 * User: songyongzhan
 * Date: 2019/2/26
 * Time: 11:18
 * Email: songyongzhan@qianbao.com
 */
import('Cart.php', 'library');

class CookieCart extends Cart {

  /**
   * @return mixed
   */
  public function getCartData() {
    // TODO: Implement getCartData() method.
    //当存在的时候，才可以返回
    $cart = [];
    if (isset($_COOKIE['cart'])) {
      foreach ($_COOKIE['cart'] as $key => $val) {
        $cart[$key] = unserialize(stripcslashes($val));
      }
    }
    return $cart;
  }

  /**
   * @param $goods
   * @return mixed
   */
  public function add($goods) {
    // TODO: Implement add() method.
    return setCookie("cart[{$goods['id']}]", serialize($goods), time() + $this->expire, "/", "", FALSE, TRUE);
  }

  /**
   * 通过id删除商品
   * @param $id
   * @return mixed
   */
  public function del($id) {
    // TODO: Implement del() method.
    if (isset($_COOKIE['cart'][$id])) {
      return setCookie("cart[$id]", "", time() - 1);
    } else {
      return FALSE;
    }
  }

  /**
   * 清空购物车
   * @return mixed
   */
  public function clearCart() {
    // TODO: Implement clearCart() method.
    if (isset($_COOKIE['cart'])) {
      foreach ($_COOKIE['cart'] as $key => $val) {
        setCookie("cart[{$key}]", "", time() - 1);
      }
    }
    return TRUE;
  }

  /**
   * 更新商品数量及属性
   * @param $goods
   * @return mixed
   */
  public function update($goods) {
    // TODO: Implement update() method.
    if (isset($_COOKIE['cart'][$_pro['id']])) {
      $_item = unserialize(stripcslashes($_COOKIE['cart'][$goods['id']]));
      $_item['count'] = $goods['count'];
      return setCookie("cart[" . $goods['id'] . "]", serialize($_item), time() + $this->expire);
    } else {
      return FALSE;
    }
  }

  /**
   * 获取购物车中商品的总数量
   * @return mixed
   */
  public function cartGoodsTotalNumbers() {
    // TODO: Implement cartGoodsTotalNumbers() method.
    $num = 0;
    $cartList = $this->cartlist();
    if ($cartList)
      $num = array_sum(array_column($cartList, 'count'));

    return $num;
  }
}