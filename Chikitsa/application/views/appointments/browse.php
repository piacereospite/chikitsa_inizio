<?php
    function inttotime($tm)
    {
        $hr  = intval($tm); 
        $min = ($tm - intval($tm)) * 60;
        $format = '%02d:%02d';
        return sprintf($format, $hr, $min);
    }
    function timetoint($time)
    {
        $hrcorrection = 0;
        if (strpos($time,'p') > 0)
                $hrcorrection = 12;
        list($hours, $mins) = explode(':', $time);
        $mins = str_replace('a','',$mins);
        $mins = str_replace('p','',$mins);
        
        return $hours + $hrcorrection + ($mins/60);
    }
?>
<div class="calendar">
<?php 

for ($i=1;$i<=31;$i++)
{
    $data[$i] = base_url() . 'index.php/appointment/index/' . $year . '/' . $month . '/' . $i;
}
echo $this->calendar->generate($year,$month,$data); 
?>


</div>
<div class="day_appointment">
<span class="current_date"><?php echo $day . "/" . $month . "/" . $year; ?></span>
<table>
    <?php 
    $start_time=timetoint($start_time);
    $end_time=timetoint($end_time);
    for ($i=$start_time;$i<$end_time;$i=$i+.5)
    {
        $title = "";
        $id = 0;
        echo "<tr>";
        echo "<td class='appointment_time'><a href='" . base_url() . "index.php/appointment/edit/" . $year . "/" . $month . "/" . $day . "/" . inttotime($i) ."'>" . inttotime($i) . "</a></td>";
        foreach ($appointments as $appointment){
            if (strtotime(inttotime($i)) == strtotime($appointment['start_time']))
            {
                $title = $appointment['title'];
                $id = $appointment['appointment_id'];
            }
        }
        echo "<td class='appointment_title'><a href='" . base_url() . "index.php/appointment/edit/" . $year . "/" . $month . "/" . $day . "/" . inttotime($i) ."'>" . $title . "</a></td>";
        
        echo "</tr>";
    }
    ?>
</table>
</div>