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
<h2>Settings</h2>
<div class="form_style">
<?php echo form_open('settings/edit') ?>
	<label for="start_time">Clinic Start Time</label> 
	<input type="input" name="start_time" id="start_time" value="<?=$settings['start_time']; ?>"/><br/>
        <label for="end_time">Clinic End Time</label> 
	<input type="input" name="end_time" id="end_time" value="<?=$settings['end_time']; ?>"/>
        <div class="button_link">
            <button type="submit" name="submit" class="save" /></button>
        </div>
</form>
</div>