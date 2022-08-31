<?php
    function Check($time)
    {
        $time = strtotime($time);
        $current_time = time();
        $diff = $current_time - $time;
        $day_diff = floor($diff / 86400);
        if($day_diff >= 1)
            return true;
        else
            return false;
    }
?>