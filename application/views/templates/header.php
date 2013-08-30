<!DOCTYPE html>
<html>
    <head>
        <title>Chikitsa - Patient Management System</title>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.6.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.1.5.2.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.1.8.2.min.js"></script>
        <script src="<?= base_url() ?>js/jquery.timepicker.js"></script>
        <script src="<?= base_url() ?>js/jquery.dataTables.js"></script>
        <script src="<?= base_url() ?>js/common.js"></script>

        <script type="text/javascript" language="javascript" src="<?= base_url() ?>js/jquery-ui.js"></script>
        <script type="text/javascript" language="javascript" src="<?= base_url() ?>js/autocomplete.js"></script>

        <link rel="stylesheet" href='<?= base_url() ?>js/jquery.timepicker.css' type="text/css"/>
        <link rel="stylesheet" href='<?= base_url() ?>js/demo_table_jui.css' type="text/css"/>
        <link rel="stylesheet" href='<?= base_url() ?>js/themes/smoothness/jquery-ui-1.8.4.custom.css' type="text/css"/>
        <link rel="stylesheet" href='<?= base_url() ?>css/style.css' type="text/css"/>

        <!--Start Lightbox JS and CSS-->

<!--        <script src="<?= base_url() ?>js/lightbox/jquery-1.7.2.min.js"></script>-->
        <script src="<?= base_url() ?>js/lightbox/lightbox.js"></script>        
        <link href="<?= base_url() ?>css/lightbox.css" rel="stylesheet" />

        <!--End Lightbox JS and CSS-->        
        
        <!-- CSS FOR MULTIPLE SELECT -->
        <link rel="stylesheet" href="<?=base_url()?>css/docsupport/chosen.css">
        <style type="text/css" media="all">
            /* fix rtl for demo */
            .chzn-rtl .chzn-drop { left: -9000px; }
        </style>
        
        <!-- END CSS MULTIPLE SELECT -->

    </head>
    <body>
        <?php
            $query = $this->db->get('clinic');
            $clinic = $query->row_array();
            
            $user_id = $this->session->userdata('id');
            $this->db->where('userid', $user_id);
            $query = $this->db->get('users');
            $user = $query->row_array();
        ?>
        <div class="header_wrapper">
            <div class="header">
                <div style="float: left">
                    
                    <?php if($clinic['clinic_name'] == NULL){ ?>
                    <h1>Chikitsa</h1>
                    <?php }else { ?>
                    <h1><?=$clinic['clinic_name'] ?></h1>
                    <?php } ?>
                    
                    <?php if($clinic['tag_line'] == NULL){ ?>
                    <h3>Patient Management System</h3>
                    <?php }else { ?>
                    <h3><?=$clinic['tag_line'] ?></h3>
                    <?php } ?>
                </div>
                <?php if($user){ ?>
                <div style="float: right; font-size: 15px; margin-top: 2px;">
                    
                    <a href="<?=  site_url("admin/change_profile"); ?>" style="color: black;text-decoration: none;"><strong><?=$user['name']; ?></strong><br /></a>
                    <?php echo $user['level']; ?> <br />
                    <?php if ($this->session->userdata('user_name') != '') { ?>                    
                    <a title="Log Out" href="<?= site_url("login/logout"); ?>" style="font-size: 11px;color: black;text-decoration: none;">Log Out</a>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>



