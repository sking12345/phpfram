<?php
namespace snow\bases;
use snow\config;

/**
 *概念:
Exchange:消息交换机,指定消息按什么规则,路由到那个队列
Queue:消息队列载体,每个消息都会被投入到一个或多个队列
Binding:绑定,它的作用就是把exchange和queue 按照路由规则绑定起来
routing key: 路由关键字,exchange根据这个关键字进行消息投递
vhost:虚拟主机,一个broker里可以开始多个vhost,用作不同用户的权限分离
product:消息生产者,就是投递消息的程序
consumer:消息消费者,就是接受消息的程序
channel:消息通道,在客户端的每个连接里,可建立多个channel，每个channel代表一个会话任务
 */

/**
 * 交换机模式:
1:直接交换机-> 根据消息携带的路由键（routing key）将消息投递给对应队列的,路由规则由路由键决定，只有满足路由键的规则，消息才可以路由到对应的队列上
2:扇形交换机->消息路由给绑定到它身上的所有队列,如果N个队列绑定到某个扇型交换机上，当有消息发送给此扇型交换机时，交换机会将消息的发送给这所有的N个队列,路由键是没有意义的，只要有消息，它都发送到它绑定的所有队列上
3:主题交换机
4:头交换机
 */
/**
 * rabbit_mq 消息队列的封装
 */
class rabbit_mq {

	private $_channel_obj; //消息通道
	private $_rabbit_conn;
	private $_exchange_obj; //交换机
	private $_queue_obj;
	private $queue_name;
	private $k_route; //路由关键字
	private $_e_name;

	private static $e_name_obj = [];

	/**
	 * 交换机名
	 */
	public function __construct($e_name = "default") {
		if (!empty(self::$e_name_obj[$e_name])) {
			return self::$e_name_obj[$e_name];
		}
		$conn_args = config::$obj->rabbit_mq->get();

		$this->_rabbit_conn = new \AMQPConnection($conn_args);
		if (!$this->_rabbit_conn->connect()) {
			die("Cannot connect to the broker!\n");
		}
		$this->_channel_obj = new \AMQPChannel($this->_rabbit_conn);
		//创建交换机
		$this->_exchange_obj = new \AMQPExchange($this->_channel_obj);
		$this->_exchange_obj->setName($e_name);
		$this->_e_name = $e_name;
		self::$e_name_obj[$e_name] = $this;
		return $this;
	}
	/**
	 * 用于消费者
	 */
	public function set_type_flags($type = AMQP_EX_TYPE_DIRECT, $flags = AMQP_DURABLE) {
		$this->_exchange_obj->setType(AMQP_EX_TYPE_DIRECT); //direct类型
		$this->_exchange_obj->setFlags(AMQP_DURABLE); //持久化
		return $this;

	}
	/**
	 * 创建队列
	 */
	public function set_queue_name($queue_name, $flags = AMQP_DURABLE) {
		$this->_queue_obj = new \AMQPQueue($this->_channel_obj);
		$this->_queue_obj->setName($queue_name);
		$this->_queue_obj->setFlags($flags); //持久化
		// \snow\log::save_log("Message Total:" . $this->_queue_obj->declare() . "\n");
		return $this;
	}

	/**
	 * 用于消费者
	 */
	public function bind_route($k_route) {
		$this->k_route = $k_route;
		$this->_queue_obj->bind($this->_e_name, $k_route);
		return $this;
	}
	/**
	 * 消费者端接受数据
	 */
	public function recvmsg($message_call_fun, $ack_type = true) {
		if ($ack_type == true) {
			while (True) {
				$this->_queue_obj->consume($message_call_fun, AMQP_AUTOACK);
			}
		} else {
			while (True) {
				$this->_queue_obj->consume($message_call_fun);
			}
		}
	}
	public function publish($message, $k_route) {
		$this->_exchange_obj->publish($message, $k_route);
	}
	public function __destruct() {
		$this->_conn->disconnect();
	}
}
