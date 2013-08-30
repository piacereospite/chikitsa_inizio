<?php
$level = $this->session->userdata('category');
?>
<div class="navigation_wrapper">
    <nav>
        <ul>
            <li><a href="<?= site_url("patient/index"); ?>">Patients</a></li>
            <li><a href="<?= site_url("appointment/index"); ?>">Appointments</a></li>
            <li><a href="#">Stock</a>
                <ul>
                    <li><a href="<?php echo site_url("stock/item"); ?>">Items</a></li>
                    <li><a href="<?php echo site_url("stock/supplier"); ?>">Supplier</a></li>
                    <li><a href="<?php echo site_url("stock/purchase"); ?>">Purchase</a></li>
                    <li><a href="#">Sell</a>
                        <ul>
                            <li><a href="<?php echo site_url("stock/all_sell"); ?>">All Sell</a></li>
                            <li><a href="<?php echo site_url("stock/sell"); ?>">New Sell</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url("stock/stock_report"); ?>">Stock Report</a></li>
                </ul>
            </li>            
            <li <?php if ($level == 'Staff') { echo 'style = display:none'; } ?>><a href="#">Report</a>
                <ul>
                    <li><a href="<?php echo site_url("appointment/appointment_report"); ?>">Appointment Report</a></li>
                    <li><a href="<?php echo site_url("stock/purchase_report"); ?>" target="_blank">Purchase Register</a></li>
                    <li><a href="<?php echo site_url("patient/bill_detail_report"); ?>" target="_blank">Bill Report</a></li>
                    <li><a href="<?php echo site_url("patient/patient_report"); ?>" target="_blank">Patient Report</a></li>
                </ul>
            </li>
            <li <?php if($level == 'Staff') { echo 'style = display:none'; } ?>><a href="<?php echo site_url("settings/treatment"); ?>">Treatments</a></li>
            <li <?php if($level == 'Staff' || $level == 'Doctor') { echo 'style = display:none'; } ?>><a href="#">Administration</a>
                <ul>
                    <li><a href="<?php echo site_url("settings/clinic"); ?>">Clinic Details</a></li>
                    <li><a href="<?php echo site_url("settings/invoice"); ?>">Invoice Settings</a></li>
                    <li><a href="<?php echo site_url("admin/users"); ?>">Users</a></li>                    
                </ul> 
            </li>
<!--            <li><a href="<?= site_url("login/logout"); ?>">Log Out</a></li>-->
        </ul>
    </nav>
</div>
<div class="content_wrapper">
