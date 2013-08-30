</div>
<?php
    $query = $this->db->get('version');
    $version = $query->row_array();    
?>
<div class="footer_wrapper">
    <div class="footer">
        <strong>&copy; 2012 <a style="color: black;text-decoration: none;" target="_blank" title="Sanskruti Technologies" href="http://sanskrutitech.in">Sanskruti Technologies</a></strong>	
        <div style="float:right;"><strong>Chikitsa Version <?php echo $version['current_version']; ?></strong></div>
    </div>
</div>
</body>
</html>