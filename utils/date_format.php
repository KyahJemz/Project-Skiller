<?php 

    function toFullDateAndTime($timestamp) {
        $date = new DateTime($timestamp);
        
        $formattedDate = $date->format('F j, Y \a\t g:ia');
        
        return $formattedDate;
    }

?>
