<?php
    # Function to format time in singlePage for duration
    function timeFormat($seconds){
        $min = FLOOR($seconds/60);
        $sec = $seconds%60;

        if($sec < 10)
            echo "$min:0$sec";
        else
            echo "$min:$sec";
    }
?>