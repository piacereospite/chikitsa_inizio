<script type="text/javascript" charset="utf-8">
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
</script>
<div class="form_style">
<?php echo form_open('patient/index') ?>
	<label for="first_name">Name</label> 
	<input type="input" name="first_name" value="<?=$this->input->post('first_name');?>"/>
	<input type="input" name="middle_name" value="<?=$this->input->post('middle_name');?>"/>
	<input type="input" name="last_name" value="<?=$this->input->post('last_name');?>"/>
        <div class="button_link">
            <button type="submit" name="submit" class="search" /></button>
        </div>
</form>
</div>

<table class="table_style">
    <tr><th>ID</th><th>Name</th><th>Appointment</th><th>Visit</th><th>Edit</th><th>Delete</th></tr>
    <?php $i=1; ?>
    <?php foreach ($patients as $patient):  ?>
    <tr <?php if ($i%2 == 0) { echo "class='alt'"; } ?> >
        <td><?php echo $patient['patient_id'] ?></td>
        <td><?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] ?></td>
        <td><a class="appointment" title="Appointment" href="<?php echo site_url("appointment/add/" . $patient['patient_id']); ?>"></a></td>
        <td><a class="visit" title="Visit" href="<?php echo site_url("patient/visit/" . $patient['patient_id']); ?>"></a></td>
        <td><a class="edit" title="Edit" href="<?php echo site_url("contact/edit/" . $patient['contact_id']); ?>"></a></td>
        <td><a class="delete confirmClick" title="<?php echo "Delete Patient :" . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] ?>" href="<?php echo site_url("patient/delete/" . $patient['patient_id']); ?>"></a></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach ?>
</table>
<?php if($this->input->post('first_name') != NULL) { ?>
<?php echo form_open('patient/insert') ?>
<input type="hidden" name="first_name" value="<?=$this->input->post('first_name');?>"/>
<input type="hidden" name="middle_name" value="<?=$this->input->post('middle_name');?>"/>
<input type="hidden" name="last_name" value="<?=$this->input->post('last_name');?>"/>
<input type="hidden" name="phone_number" value=""/>
<input type="hidden" name="address_line_1" value=""/>
<input type="hidden" name="address_line_2" value=""/>
<input type="hidden" name="city" value=""/>
<input type="hidden" name="postal_code" value=""/>
<input type="hidden" name="state" value=""/>
<input type="hidden" name="country" value=""/>
<div class="button_link">
    <button type="submit" name="submit" class="add" /></button>
</div>
</form>
<?php } ?>
