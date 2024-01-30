<?php 

    $CounterTextColor = 0;
    $CounterBgColor = 0;
    $CounterBadgeColor = 0;

    function getNextTextColor() {
        global $CounterTextColor;

        if ($CounterTextColor === 5) {
            $CounterTextColor = 0;
        }

        $options = [
            'text-primary',
            'text-success',
            'text-danger',
            'text-warning',
            'text-info'
        ];

        $text = $options[$CounterTextColor];

        $CounterTextColor++;
        
        return $text;
    }

    function getNextBgColor() {
        global $CounterBgColor;

        if ($CounterBgColor === 5) {
            $CounterBgColor = 0;
        }

        $options = [
            'bg-primary',
            'bg-success',
            'bg-danger',
            'bg-warning',
            'bg-info'
        ];

        $text = $options[$CounterBgColor];

        $CounterBgColor++;
        
        return $text;
    }

    function getNextBadgeColor() {
        global $CounterBadgeColor;
        
        if ($CounterBadgeColor === 5) {
            $CounterBadgeColor = 0;
        }

        $options = [
            'badge-primary',
            'badge-success',
            'badge-danger',
            'badge-warning',
            'badge-info'
        ];

        $text = $options[$CounterBadgeColor];

        $CounterBadgeColor++;
        
        return $text;
    }

?>
