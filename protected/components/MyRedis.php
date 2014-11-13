<?php

class MyRedis extends CComponent
{
  private $_redis;
 
  public function init()
  {
    try {
      $this->_redis = new Redis();
      $this->_redis->connect('localhost', 6379);
    } catch (RedisException $e) {
      die("Ошибка подключения к Redis");
    }
    $this->_redis->setOption(Redis::OPT_PREFIX, 'yii.');
    $this->_redis->select(1);
  }
 
  public function get($key)
  {
    if (preg_match('/^arr_/', $key))
      return unserialize($this->_redis->get($key));
    return $this->_redis->get($key);
  }
 
  public function setValue($key, $value)
  {
   // if (is_array($value))
    //  $value = serialize($value);
    $this->_redis->set($key, $value);
   // $this->_redis->save();
  }
 
}

