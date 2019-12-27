<?php
$acummulatedRevenue = isset($_SESSION['acummulatedRevenue'])?$_SESSION['acummulatedRevenue']: 0;
header('Content-Type: text/javascript');
$_SESSION['acummulatedRevenue'] = $acummulatedRevenue + rand( 0, 100000 ) / 100;
echo number_format($_SESSION['acummulatedRevenue'], 2, ',', '.' );