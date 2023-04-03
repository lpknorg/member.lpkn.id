<?php
require_once("qrlib.php");

QRcode::png($_GET['code'], $outfile=false, $level=QR_ECLEVEL_L, $size=2, $margin=0, $saveandprint=false);