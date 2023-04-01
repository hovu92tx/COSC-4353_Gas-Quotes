<?php
require 'connect.php';
$userid = $_SESSION['userid'];
$sql2 = "SELECT * FROM orders WHERE user_id LIKE $userid";
$statement2 = $conn->query($sql2);
$results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
foreach ($results2 as $result2) {
    $order_id = $result2['order_id'];
    $order_date = $result2['order_date'];
    $order_total = $result2['order_total'];
    $html = '<form id="item" action="order_detail.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="order_id"><input id="infor" name="order_id" type="text" value="' . $order_id . ' "readonly="readonly"></input></th>
                                        <th id="date">' . date('m-d-Y', strtotime($order_date)) . '</th>
                                        <th id="add">' . $_SESSION['cus_add1'] . ', ' . $_SESSION['cus_city'] . ', ' . $_SESSION['cus_state'] . ', ' . $_SESSION['cus_zipcode'] . '</th>
                                        <th id="total">$' . number_format($order_total, 2) . '</th>
                                        <th id="action"><button id="form_button" type="submit" name="order_detail">Order Detail</button></th>
                                    </tr>
                                </table></form>';
    echo $html;
}
