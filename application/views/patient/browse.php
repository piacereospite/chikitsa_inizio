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

$(document).ready(function() {
    oTable = $('#patient_table').dataTable({
        "aaSorting": [[ 1, "asc" ]],
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );
</script>
<div class="form_style">
    <?php echo form_open('patient/insert') ?>
    <table>
        <tr>
            <td><label for="first_name">First Name</label></td>
            <td><label for="middle_name">Middle Name</label></td>
            <td><label for="last_name">Last Name</label></td>
        </tr>
        <tr>
            <td><input type="text" name="first_name" value="<?=$this->input->post('first_name');?>"/></td>
            <td><input type="text" name="middle_name" value="<?=$this->input->post('middle_name');?>"/></td>
            <td><input type="text" name="last_name" value="<?=$this->input->post('last_name');?>"/></td>
        </tr>
    </table>
    
    <input type="hidden" name="phone_number" value=""/>
    <input type="hidden" name="address_line_1" value=""/>
    <input type="hidden" name="address_line_2" value=""/>
    <input type="hidden" name="city" value=""/>
    <input type="hidden" name="postal_code" value=""/>
    <input type="hidden" name="state" value=""/>
    <input type="hidden" name="country" value=""/>
    <div class="button_link">
        <button type="submit" name="submit" class="button">Add Patient</button>
    </div>
    </form>
</div>
<div id="example_wrapper" class="dataTables_wrapper" role="grid">
<table id="patient_table" class="display">
    <thead>
    <tr><th>ID</th><th>Name</th><th>Appointment</th><th>Visit</th><th>Delete</th></tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    <?php foreach ($patients as $patient):  ?>
    <tr <?php if ($i%2 == 0) { echo "class='alt'"; } ?> >
        <td><?php echo $patient['patient_id'] ?></td>
        <td><a class="link" title="Edit" href="<?php echo site_url("contact/edit/" . $patient['contact_id']); ?>"><?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] ?></a></td>
        <td><a class="button" title="Appointment" href="<?php echo site_url("appointment/add/" . $patient['patient_id']); ?>">Give Appointment</a></td>
        <td><a class="button" title="Visit" href="<?php echo site_url("patient/visit/" . $patient['patient_id']); ?>">Patient Visit</a></td>
        <td><a class="button confirmClick" title="<?php echo "Delete Patient :" . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] ?>" href="<?php echo site_url("patient/delete/" . $patient['patient_id']); ?>">Delete Patient</a></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach ?>
    </tbody>
</table>
</div>


