<script type="text/javascript" charset="utf-8">
    
$(function()
{
    $('.date-pick').datePicker({clickInput:true})
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
    }
    else
    {
        $header = "Edit Appointment";
        $id = $appointment['id'];
        $title = $appointment['title'];
        $start_time = $appointment['start_time'];
        $end_time = $appointment['end_time'];
    }
?>
<div class="form_style">
<h2><?=$header?></h2><br/>
<span class="err"><?php echo validation_errors(); ?></span>
<?php echo form_open('appointment/edit') ?>
    <input type="hidden" name="id" value="<?=$id?>"/><br/>
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
        <button class="save" type="submit" name="submit" /></button>
        <?php 
            if ($id !=NULL)
            { ?>
            <a class="delete" href="<?php echo base_url() . "index.php/appointment/delete/" . $id . "/" . $appointment_date; ?>"></a>
            <?php }
        ?>
    </div>
</form>
</div>