<script type="text/javascript" charset="utf-8">
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
<h2>Clinic Details</h2>
<div class="form_style">
<?php echo form_open('settings/clinic') ?>
        <label for="clinic_name">Clinic Name</label> 
	<input type="input" name="clinic_name" value="<?=$clinic['clinic_name']; ?>"/><br/>
        <label for="tag_line">Tag Line</label> 
	<input type="input" name="tag_line" style="width:500px;" value="<?=$clinic['tag_line']; ?>"/><br/>
	<label for="start_time">Clinic Start Time</label> 
	<input type="input" name="start_time" id="start_time" value="<?=$clinic['start_time']; ?>"/><br/>
        <label for="end_time">Clinic End Time</label> 
	<input type="input" name="end_time" id="end_time" value="<?=$clinic['end_time']; ?>"/><br/>
        <label for="clinic_address">Clinic Address</label> 
	<textarea name="clinic_address"><?=$clinic['clinic_address']; ?></textarea><br/>
        <label for="landline">Clinic Landline</label> 
	<input type="input" name="landline" value="<?=$clinic['landline']; ?>"/><br/>
        <label for="mobile">Mobile</label> 
	<input type="input" name="mobile" value="<?=$clinic['mobile']; ?>"/><br/>
        <label for="email">Email</label> 
	<input type="input" name="email" value="<?=$clinic['email']; ?>"/><br/>
        <div class="button_link">
            <button type="submit" name="submit" class="button" />Save</button>
        </div>
</form>
</div>