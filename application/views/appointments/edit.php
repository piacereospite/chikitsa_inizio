<script type="text/javascript" charset="utf-8">
$(function() {
        $( "#appdate" ).datepicker({
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true
        });
});
$(function()
{
    $('#start_time').timepicker({
        'minTime': '12:00am',
	'maxTime': '12:00am'
    });    
});
$(function()
{
    $('#end_time').timepicker({
        'minTime': '12:00am',
	'maxTime': '12:00am'
    });    
});	
$(function()
{
    $("#patient_name").autocomplete({
        source: [<?php
                $i=0;
                foreach ($patients as $patient){
                    if ($i>0) {echo ",";}
                    echo '{value:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " .$patient['last_name'] . '",id:"' . $patient['patient_id'] . '"}';
                    $i++;
                }
            ?>],
        minLength: 1,//search after one characters
        select: function(event,ui){
            //do something
            $("#patient_id").val(ui.item ? ui.item.id : '');

        }
});   
});	
</script>
<?php
    if ($appointment == NULL)
    {
        $header = "New Appointment";
        $title = "";
        $id = "";
        $start_time = $appointment_time;
        $appointment_endtime = date("H:i",strtotime($appointment_time) + (30*60));
        $end_time = $appointment_endtime;
        $patient_id = 0;
        $patient_name = '';
    }
    else
    {
        $header = "Edit Appointment";
        $id = $appointment['appointment_id'];
        $title = $appointment['title'];
        $start_time = $appointment['start_time'];
        $end_time = $appointment['end_time'];
        $patient_id = $appointment['patient_id'];
        foreach($patients as $patient)
        {
            if ($patient_id == $patient['patient_id'])
            $patient_name = $patient['first_name'] . " " . $patient['middle_name'] . " " .$patient['last_name'];
        }
    }
    
    
?>
<div class="form_style">
<h2><?=$header?></h2><br/>
<span class="err"><?php echo validation_errors(); ?></span>
<?php echo form_open('appointment/edit') ?>
    <input type="hidden" name="id" value="<?=$id?>"/><br/>
    <input type="hidden" name="patient_id" id="patient_id" value="<?=$patient_id;?>"/><br/>
    <label for="patient">Patient</label>
    <input type="text" name="patient_name" id="patient_name" value="<?=$patient_name;?>"/><br/>
    <br/>
    <label for="title">Title</label>
    <input type="text" name="title" value="<?=$title?>"/><br/>
    <label for="start_time">Start Time</label>
    <input type="text" name="start_time" id="start_time" value="<?=$start_time;?>"/><br/>
    <label for="end_time">End Time</label>
    <input type="text" name="end_time" id="end_time" value="<?=$end_time;?>"/><br/>
    <label for="appointment_date">Date</label>
    <input name="appointment_date" id="appdate" class="date-pick dp-applied" value="<?=$appointment_date;?>"/>
    <br/>
    <div class="button_link" >
        <button class="button" type="submit" name="submit" />Save</button>
        <?php 
            if ($id !=NULL)
            { ?>
            <a class="button" href="<?php echo base_url() . "index.php/appointment/delete/" . $id . "/" . $appointment_date; ?>">Delete</a>
            <?php }
        ?>
    </div>
</form>
</div>