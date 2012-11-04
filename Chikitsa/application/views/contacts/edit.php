<div class="form_style">
<h2>Edit Contact</h2><br/>

<span class="err"><?php echo validation_errors(); ?></span>
<?php echo form_open('contact/edit') ?>
        <input type="hidden" name="contact_id" class="inline" value="<?=$contacts['contact_id'];?>"/>
        <input type="hidden" name="address_id" class="inline" value="<?=$address['address_id'];?>"/>
        <input type="hidden" name="patient_id" class="inline" value="<?=$patient_id;?>"/>
	<label for="first_name">Name</label> 
	<input type="input" name="first_name" class="inline" value="<?php echo $contacts['first_name'] ?>"/>
        <input type="input" name="middle_name" class="inline" value="<?php echo $contacts['middle_name'] ?>"/>
        <input type="input" name="last_name" class="inline" value="<?php echo $contacts['last_name'] ?>"/><br/>
        <div id="email" style="float:right;width:300px;">            
            <label for="email" style="text-align:left;">Email</label><br/>
            <?php foreach($emails as $email)
            {?>
                <input type="hidden" name="email_id[]" value="<?php echo $email['contact_detail_id']; ?>"/>
                <input type="input" name="email[]" value="<?php echo $email['detail']; ?>"/>
            <?php } ?>
            <button class="add_email" type="button"></button>
        </div>
        <label for="phone_number">Phone Number</label>
        <input type="input" name="phone_number" value="<?php echo $contacts['phone_number'] ?>"/><br/>
        <label for="type">Address Type</label> 
        <select name="type">
            <option value="Home" <?php if ($address['type']=="Home") {echo "selected";} ?>>Home</option>
            <option value="Office" <?php if ($address['type']=="Office") {echo "selected";} ?>>Office</option>
        </select><br/>
        <label for="type">Address Line 1</label> 
        <input type="input" name="address_line_1" value="<?php echo $address['address_line_1'] ?>"/><br/>
        <label for="type">Address Line 2</label> 
        <input type="input" name="address_line_2" value="<?php echo $address['address_line_2'] ?>"/><br/>
        <label for="city">City</label> 
        <input type="input" name="city" value="<?php echo $address['city'] ?>"/><br/>
        <label for="state">State</label> 
        <input type="input" name="state" value="<?php echo $address['state'] ?>"/><br/>
        <label for="postal_code">Postal Code</label> 
        <input type="input" name="postal_code" value="<?php echo $address['postal_code'] ?>"/><br/>
        <label for="country">Country</label> 
        <input type="input" name="country" value="<?php echo $address['country'] ?>"/><br/>
        <div class="button_link">
            <button class="save" type="submit" name="submit" /></button>
            <a class="back" href="<?php echo site_url("patient/visit/" . $patient_id);?>"></a>
        </div>
</form>
</div>