<?php
global $transactions, $total;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Check
                </th>
                <th>
                    Description
                </th>
                <th>
                    Amount
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($transactions as $transaction) {
            echo '<tr>';
                foreach ($transaction as $transactionItem) {
                    echo "<td> $transactionItem </td>";
                }
            echo "</tr>";
        } ?>
        <tr>
            <td colspan="4">
                <?php
                    echo '<strong>Total Income: </strong>' . addCurr($total['income']) . '<br>' ;
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <?php
                echo '<strong>Total Expenses: </strong>' . addCurr($total['expense']) . '<br>' ;
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <?php
                echo  '<strong>Total Amount: </strong>' . addCurr($total['profit']) . '<br>' ;
                ?>
            </td>
        </tr>
        </tbody>
    </table>
</body>
</html>