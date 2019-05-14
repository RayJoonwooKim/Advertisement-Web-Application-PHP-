<?php
$now = date('Y-m-d');
$start_date = strtotime($now);
$end_date = strtotime("+7 day", $start_date);
echo date('Y-m-d', $start_date) . '  + 7 days =  ' . date('Y-m-d', $end_date);