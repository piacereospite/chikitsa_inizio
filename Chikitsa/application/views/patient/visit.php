<script type="text/javascript" charset="utf-8">
Date.format = 'dd-mm-yyyy';
$(function()
{
    $('.date-pick').datePicker({clickInput:true})
});
</script>
<div class="view_style">
    <span class="view_label">Name :</span>
    <span class="view_detail"><?php echo $patient['first_name'] . " " . $patient['middle_name']. " " . $patient['last_name'];?></span><br/>
    <span class="view_label">Mobile :</span>
    <span class="view_detail"><?=$patient['phone_number'];?></span><br/>
    <span class="view_label">Email :</span>
    <span class="view_detail"><?=$patient['emails'];?></span><br/>
    <span class="view_label">Address :</span>
    <?php foreach ($addresses as $address):  ?>
        <span class="view_label">(<?php echo $address['address_type'];?>)</span>
        <span class="view_detail"><?php echo $address['address'];?></span><br/>
    <?php endforeach ?>
    <div class="button_link">
        <a class="edit" title="Edit" href="<?php echo site_url("contact/edit/" . $patient['patient_id']); ?>"></a>
    </div>
</div>
<div class="form_style">
<h2>New Visit</h2><br/>

<span class="err"><?php echo validation_errors(); ?></span>

<?php echo form_open('patient/visit') ?>

        <input type="hidden" name="patient_id" value="<?=$patient_id;?>"/>
        <label for="visit_date">Date</label>
        <input name="visit_date" id="visit_date" class="date-pick dp-applied" value="<?php echo date('d-m-Y'); ?>"/>
        <label for="visit_time">Time</label>
        <input name="visit_time" id="visit_time" value="<?php echo date('H:i:s'); ?>"/><br/>
        <label for="notes">Type</label> 
        <select name="type">
            <option value="New Visit">New Visit</option>
            <option value="Established Patient">Established Patient</option>
        </select><br/>
	<label for="notes">Notes</label> 
	<textarea name="notes"></textarea><br/>
        <div class="button_link">
            <button class="save" type="submit" name="submit" /></button>
        </div>
</form>
</div>
<table class="table_style">
    <?php $i=1; ?>
    <?php foreach ($visits as $visit):  ?>
    <?php if ($i == 1){?>
        <tr><th width="100px;">Date</th><th width="100px;">Type</th><th>Notes</th></tr>
    <?php }
    ?>
    <tr <?php if ($i%2 == 0) { echo "class='alt'"; } ?> >
        <td><?=date("d-m-Y",strtotime($visit['visit_date']));?><br/><?=$visit['visit_time'];?></td>
        <td><?=$visit['type']; ?></td>
        <td><?=$visit['notes']; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach ?>
</table>
