<?php

    function convert_currency($amount, $cur_from, $cur_to, $use_symbol=false)
    {
        return;
    }

    function round_thousand($price = 0)
    {
        // 922.871.845778
        if($price > 1000) return round($price / 1000) * 1000;
        else return $price;
    }