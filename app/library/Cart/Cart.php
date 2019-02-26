<?php

//购物车工具类
abstract class Cart {
  protected $expire = 0; //定义超时时间

  //默认保存时长1周
  public function __construct($expire = 604800) {
    $this->expire = $expire;
  }

  /**
   * @return mixed
   */
  public abstract function getCartData();

  /**
   * @param $goods
   * @return mixed
   */
  public abstract function add($goods);

  /**
   * 通过id删除商品
   * @param $id
   * @return mixed
   */
  public abstract function del($id);

  /**
   * 清空购物车
   * @return mixed
   */
  public abstract function clearCart();

  /**
   * 更新商品数量及属性
   * @param $goods
   * @return mixed
   */
  public abstract function update($goods);

  /**
   * 获取购物车中商品的总数量
   * @return mixed
   */
  public abstract function cartGoodsTotalNumbers();


  //返回商品列表
  public function cartList() {
    //当存在的时候，才可以返回
    return $this->getCartData();
  }

}

?>