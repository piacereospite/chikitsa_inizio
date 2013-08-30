<h2>Invoice Details</h2>
<div class="form_style">
<?php echo form_open('settings/invoice') ?>
        <label for="static_prefix">Static Prefix</label> 
	<input type="input" name="static_prefix" value="<?=$invoice['static_prefix']; ?>"/><br/>
        <label for="left_pad">Left Pad</label> 
	<input type="input" name="left_pad" value="<?=$invoice['left_pad']; ?>"/><br/>
        <div class="button_link">
            <button type="submit" name="submit" class="button" />Save</button>
        </div>
</form>
</div>