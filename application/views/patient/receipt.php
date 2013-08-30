<html>
<head>
	<title></title>
        <script type="text/javascript" language="javascript" src="<?=base_url()?>js/jquery.dropdownPlain.js"></script>
        
        <link rel="stylesheet" href='<?=base_url()?>css/style.css' type="text/css"/>
</head>
<body>
<div class="receipt">
    <div class="header">
        <h1><?=$clinic['clinic_name']?></h1>
        <h2><?=$clinic['tag_line']?></h2>
        <br/>
        <span class="clinic_address"><?=$clinic['clinic_address']?></span>
        <span class="contact"><strong>Landline : </strong><?=$clinic['landline']?>&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>Mobile : </strong><?=$clinic['mobile']?>&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>Email : </strong> <?=$clinic['email']?></span>
        <hr/>
    </div>
        <h3>Receipt</h3>
        <span class="bill_date"><strong>Date : </strong><?=date( 'd/m/Y h:i A',strtotime($bill['bill_date']))?></span>
        <span class="bill_no"><strong>Receipt Number : </strong><?=$invoice['static_prefix'] . sprintf("%0" .$invoice['left_pad'] . "d",$bill['bill_id'])?></span>
        <span class="patient_name"><strong>Patient Name : </strong><? echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'];?></span>
        <hr/>
        <span>Received fees for Professional services and other charges of our:</span>
        <table>
            <tr>
                <th class="particular">Particular</th>
                <th class="amount">Amount</th>
            </tr>    
            <?php foreach ($bill_details as $bill_detail):  ?>
            <tr>
                <td class="particular"><?php echo $bill_detail['particular'] ?></td>
                <td class="amount"><?php echo $bill_detail['amount'] ?></td>
            </tr>
            <?php endforeach ?>
            <tr>
                <th class="particular">Total</th>
                <th class="amount"><?=$bill['total_amount']?></th></tr>
        </table>
        <span class="alignleft">Received with thanks</span>
        <span class="alignright">For <?=$clinic['clinic_name']?></span>
        <br/><br/><br/><br/>
        <span class="alignleft">Subject to Surat Jurisdiction</span>
        <span class="alignright">Signature</span>
    </div>
</div>
</body>
</html>