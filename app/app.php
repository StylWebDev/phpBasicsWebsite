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
            (float) str_replace(',', '', str_replace('$','',$transaction[3]))
        ];
    }, $transactions);
}

function calcTotalAmount(array $transactions): float {
    return array_reduce($transactions, fn($total, $transaction) => $total + (float) $transaction[3], 0);
}

function calcIncome(array $transactions): float {
    return array_reduce($transactions, function($total, $transaction) {
        if ($transaction[3] > 0) {
            return $total + (float) $transaction[3];
        }
        return $total + 0;
    }, 0 );
}
function calcExpense(array $transactions): float {
    return array_reduce($transactions, function($total, $transaction) {
        if ($transaction[3] < 0) {
            return $total + (float) $transaction[3];
        }
        return $total + 0;
    }, 0 );}

function addCurr(float $amount): string {
    if ($amount < 0) {
        return  '-' . '$' . str_replace('-', '', (string) $amount);
    }
    else return '$' . $amount;
}