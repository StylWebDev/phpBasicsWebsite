<?php
require_once  '../app/app.php';
function getTransactionFiles(): array {

    $files = [];

    foreach(scandir(TRANSACTIONS_PATH) as $file) {
        if (is_dir($file)) {
            continue;
        }

        $files[] = TRANSACTIONS_PATH . $file;
    }

    return $files;
}

function getTransactions($filePath): array {
    $transactions = [];
    if (file_exists($filePath)) {
        $openedFile = fopen($filePath, "r");
        fgetcsv($openedFile, escape: ',');
        while(($line = fgetcsv($openedFile,escape: ',')) !== false) {
                $transactions[] = $line;
        }

        fclose($openedFile);
    }

    return $transactions;
}

function formatfTransactions(array $transactions): array {
    return array_map(function($transaction) {
        return [
            date('Y-M-D' , strtotime( str_replace('/','-',$transaction[0]))),
            $transaction[1],
            $transaction[2],
            (float) str_replace('$','',$transaction[3])
        ];
    }, $transactions);
}

function calcTotalAmount(array $transactions) {
    echo array_reduce($transactions, fn($total, $transaction) => $total + (float) $transaction[0], 0);
}