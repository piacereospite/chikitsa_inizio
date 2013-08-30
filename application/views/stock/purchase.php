<script type="text/javascript" charset="utf-8">
$(function() {
        $( "#purchase_date" ).datepicker({
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true
        });
});
$(function()
{
    $("#item_name").autocomplete({
        source: [<?php
                $i=0;
                foreach ($items as $item){
                    if ($i>0) {echo ",";}
                    echo '{value:"' . $item['item_name'] . '",id:"' . $item['item_id'] . '"}';
                    $i++;
                }
            ?>],
        minLength: 1,//search after one characters
        select: function(event,ui){
            //do something
            $("#item_id").val(ui.item ? ui.item.id : '');

        }
    });   
});	
$(function()
{
    $("#supplier_name").autocomplete({
        source: [<?php
                $i=0;
                foreach ($suppliers as $supplier){
                    if ($i>0) {echo ",";}
                    echo '{value:"' . $supplier['supplier_name'] . '",id:"' . $supplier['supplier_id'] . '"}';
                    $i++;
                }
            ?>],
        minLength: 1,//search after one characters
        select: function(event,ui){
            //do something
            $("#supplier_id").val(ui.item ? ui.item.id : '');

        }
    });   
});	
$(function()
{
    $(".confirmClick").click( function() { 
        if ($(this).attr('title')) {
            var question = 'Are you sure you want to ' + $(this).attr('title').toLowerCase() + '?';
        } else {
            var question = 'Are you sure you want to do this action?';
        }
        if ( confirm( question ) ) {
            [removed].href = this.src;
        } else {
            return false;
        }
    });
    
});

$(document).ready(function() {
    oTable = $('#item_table').dataTable({
        "aaSorting": [[ 1, "asc" ]],
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );
</script>
<h2>Purchase</h2>
<div class="form_style">
<?php echo form_open('stock/purchase') ?>
    <label for="purchase_date">Purchase Date</label> 
    <input type="input" name="purchase_date" id="purchase_date"/><br/>
    <input type="hidden" name="item_id" id="item_id"/>
    <label for="item_name">Item</label> 
    <input type="input" name="item_name" id="item_name"/><br/>
    <label for="quantity">Quantity</label> 
    <input type="input" name="quantity"/><br/>
    <input type="hidden" name="supplier_id" id="supplier_id"/>
    <label for="supplier_name">Supplier</label> 
    <input type="input" name="supplier_name" id="supplier_name"/><br/>
    <label for="cost_price">Cost Price</label> 
    <input type="input" name="cost_price"/><br/>
    <div class="button_link">
        <button type="submit" name="submit" class="button" />Save</button>
    </div>
</form>

<div id="example_wrapper" class="dataTables_wrapper" role="grid">
<table id="item_table" class="display">
    <thead>
        <tr><th>ID</th><th>Item</th><th>Quantity</th><th>Supplier</th><th>Cost Price</th><th>Edit</th><th>Delete</th></tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    <?php foreach ($purchases as $purchase):  ?>
    <tr>
        <td><?php echo $purchase['purchase_id'] ?></td>
        <td><?php echo $purchase['item_name'] ?></td>
        <td><?php echo $purchase['quantity'] ?></td>
        <td><?php echo $purchase['supplier_name'] ?></td>
        <td><?php echo $purchase['cost_price'] ?></td>
        <td><a class="button" title="Edit" href="<?php echo site_url("stock/edit_purchase/" . $purchase['purchase_id']); ?>">Edit</a></td>
        <td><a class="button confirmClick" title="<?php echo "Delete Purchase";?>" href="<?php echo site_url("stock/delete_purchase/" . $purchase['purchase_id']); ?>">Delete</a></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach ?>
    </tbody>
</table>
</div>

</div>