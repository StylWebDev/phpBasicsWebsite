<?php

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . "app" . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('TRANSACTIONS_PATH', $root . 'transFiles' . DIRECTORY_SEPARATOR);

require APP_PATH . 'app.php';

$files = getTransactionFiles();
$transactions = formatfTransactions(getTransactions($files[0]));
$total = calcTotalAmount($transactions);

require  VIEWS_PATH . 'styl.php';

