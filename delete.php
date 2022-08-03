<?php

$ma = $_GET['ma'];
require'conect.php';
$truy_van = "delete from tin_tuc
where ma = '$ma'";
mysqli_query($ket_noi,$truy_van);
mysqli_close($ket_noi);