<script type="text/javascript" charset="utf-8">
$(function() {
        $( "#visit_date" ).datepicker({
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true
        });
});
$(document).ready(function() {
    oTable = $('#visit_table').dataTable({
        "aaSorting": [[ 0, "asc" ]],
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );
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
    <br/>
    <a class="button" title="Edit" href="<?php echo site_url("contact/edit/" . $patient['patient_id']); ?>">Edit</a>
</div>
<div class="form_style">
<h2>New Visit</h2><br/>

<span class="err"><?php echo validation_errors(); ?></span>

<?php echo form_open('patient/visit') ?>

        <input type="hidden" name="patient_id" value="<?=$patient_id;?>"/>
        <label for="visit_date">Date</label>
        <input name="visit_date" id="visit_date" value="<?php echo date('d-m-Y'); ?>"/><br/>
        <label for="visit_time">Time</label>
        <input name="visit_time" id="visit_time" value="<?php echo date('H:i:s'); ?>"/><br/>
        <label for="notes">Type</label> 
        <select name="type">
            <option value="New Visit">New Visit</option>
            <option value="Established Patient">Established Patient</option>
        </select><br/>
	<label for="notes">Notes</label> 
	<textarea name="notes"></textarea><br/>
        <br/>
        <button class="button" type="submit" name="submit" />Save</button>
</form>
</div>
<?php if ($visits) {?>
    <div id="example_wrapper" class="dataTables_wrapper" role="grid">
    <table id="visit_table" class="display">
        <thead>
            <tr><th width="100px;">Date</th><th width="100px;">Type</th><th>Notes</th><th>Bill</th></tr>
        </thead>
        <?php $i=1; ?>
        <?php foreach ($visits as $visit):  ?>
        <tbody>
            <tr <?php if ($i%2 == 0) { echo "class='alt'"; } ?> >
                <td><?=date("d-m-Y",strtotime($visit['visit_date']));?> <?=$visit['visit_time'];?></td>
                <td><?=$visit['type']; ?></td>
                <td><?=$visit['notes']; ?></td>
                <td><a class="button" href="<?=site_url('patient/bill') . "/" . $visit['visit_id']. "/" .$visit['patient_id'] ;?>">Bill</a></td>
            </tr>
        </tbody>
        <?php $i++; ?>
        <?php endforeach ?>
    </table>
    </div>
<?php } ?>
