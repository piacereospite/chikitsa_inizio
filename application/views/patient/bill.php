<script type="text/javascript" charset="utf-8">
$(function() {
        $( "#bill_date" ).datepicker({
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true
        });
});
</script>
<div class="form_style">
<h2>New Bill</h2><br/>

<span class="err"><?php echo validation_errors(); ?></span>

<?php echo form_open('patient/bill/' . $visit_id . '/' . $patient_id) ?>
        <input type="hidden" name="visit_id" value="<?=$visit_id?>"/>
        <input type="hidden" name="patient_id" value="<?=$patient_id?>"/>
        <input type="hidden" name="bill_id" value="<?=$bill_id?>"/>
        <label for="patient">Patient</label>
        <input name="patient" value="<?=$patient['first_name'] . " " . $patient['middle_name']. " " . $patient['last_name']?>"/><br/>
        <label for="bill_date">Date</label> 
        <input name="bill_date" id="bill_date" value="<?php echo date('d-m-Y'); ?>"/><br/>
        <h3>Bill</h3><br/>
        <a class="button" title="Print" target="_blank" href="<?php echo site_url("patient/print_receipt/" . $visit_id); ?>">Print Receipt</a><br/>
        <br/>
        <table class="table_style">
            <tr><th>Particular</th><th>Amount</th><th>Action</th></tr>
            <tr><td><input name="particular"/></td><td><input name="amount"/></td>
                        <td><button class="button" type="submit" name="submit" />Add</button></td></tr>
            <?php if ($bill_details != NULL) { ?>
                <?php $i=1; ?>
                <?php foreach ($bill_details as $bill_detail):  ?>
                <tr <?php if ($i%2 == 0) { echo "class='alt'"; } ?> >
                    <td><?php echo $bill_detail['particular'] ?></td>
                    <td style="text-align:right;"><?php echo $bill_detail['amount'] ?></td>
                    <td><a class="button" title="Delete" href="<?php echo site_url("patient/delete_bill_detail/" . $bill_detail['bill_detail_id'] . "/" . $bill_id . "/" . $visit_id . "/" . $patient_id); ?>">Delete</a></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach ?>
                <tr class='total'>
                    <th style="text-align:left;">Total</th>
                    <th style="text-align:right;"><?php echo $bill['total_amount'] ?></th>
                    <th></th>
                </tr>
            <?php } ?>
        </table>
</form>

</div>