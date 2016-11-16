<?php

namespace App\RedisHandlers;


use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;
 
class OrderCreatedEventHandler {
 
   protected $message;
   CONST EVENT = 'orders.update';
   CONST CHANNEL = 'orders.update';
   
   public function __construct() {
      //
   }
   public function handle(OrderCreated $event) {
   	  $this->message = $event->message;
      $redis = Redis::connection();
      $redis->publish(self::CHANNEL,  $this->message);
   }
}


