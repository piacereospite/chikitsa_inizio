<?php
    echo "<table class='table_style'><thead>";
    echo "<tr>";
    echo "<th>Item Name</th><th>Desired Stock</th><th>Available Stock</th><th>Bought Quantity</th><th>Sold Quantity</th><th>Bought At</th>";
    echo "<th>Sold At</th><th>Gain</th></tr></thead>";
    foreach ($stock_report as $stock){
        echo "<tr>";
        echo "<td>".$stock['item_name']."</td><td style='text-align:right'>".$stock['desired_stock']."</td>";
        if (($stock['purchase_quantity']-$stock['sell_quantity'])<$stock['desired_stock'])
        {
            echo "<td class='red-bg' style='text-align:right'>";
        }
        else
        {
            echo "<td style='text-align:right'>";
        }
        echo $stock['purchase_quantity']-$stock['sell_quantity']."</td>";
        echo "<td style='text-align:right'>".$stock['purchase_quantity']."</td><td style='text-align:right'>".$stock['sell_quantity']."</td>";
        echo "<td style='text-align:right'>".sprintf("%01.2f", $stock['avg_purchase_price'])."</td>";
        $profit=$stock['avg_sell_price']-$stock['avg_purchase_price'];
        echo "<td style='text-align:right'>".sprintf("%01.2f", $stock['avg_sell_price'])."</td><td style='text-align:right'>".sprintf("%01.2f", $profit)."</td></tr>";
    }
    echo "</table>";
?>
