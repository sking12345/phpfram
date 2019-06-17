<?php
header("Content-type: text/html; charset=utf8");
defined('_DEBUG_') or define('_DEBUG_', true);
defined('_ENV_') or define('_ENV_', 'dev');

require __DIR__ . '/../snow/autoload.php';
$config = require __DIR__ . '/../app/configs/web.php';
\snow\config::init($config);

\snow\util::mq_recvmsg("e_linvo", "key_1", function ($envelope, $queue) {
	print_r($envelope);
	$queue->ack($envelope->getDeliveryTag());
}, "q_linvo", false);
echo "\r\n";
