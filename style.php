<?php
header("Content-type: text/css");
$font_family = 'Arial, Helvetica, sans-serif';
$font_size = '1em';
$border = '1px solid';

?>

table {
margin: 20px;
}

th {
font-family: <?= $font_family ?>;
font-size: <?= $font_size ?>;
background: #666;
color: #FFF;
padding: 2px 6px;
border-collapse: separate;
border: <?= $border ?> #000;
}

td {
font-family: <?= $font_family ?>;
font-size: <?= $font_size ?>;
border: <?= $border ?> #DDD;
padding: 0.3rem;
}