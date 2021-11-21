<?php
header("Content-type: text/css");
$font_family = 'Arial, Helvetica, sans-serif';
$font_size = '1em';
$std_border = '1px solid';
$dash_border = '1px dashed';
$border_base = '3px solid';
$bg_image = "./content/images/bg-pano.jpeg";
$bg_image_mobile = "./content/images/bg-pano-mobile.jpeg";
$light_grey = "#f3f3f3f3";
$header_teal = "#2A9D8F";

?>

body {
    font-family: <?= $font_family ?>;
    background-image: url(<?= $bg_image ?>);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    max-width: 960px;
    margin: auto;
    align-items: center;
    color: white;
    padding-top: 10%;
}


body::after {
    content: "";
    background: rgba(0, 0, 0, 0.1);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
}

section.view {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: rgba(0,0,0, 0.7);
    max-width: 100%;
    border-radius: 5px;
    margin-bottom: 2rem;
}

table.admin_table{
    margin: 20px;
    border-collapse: collapse;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    border: 0;
    border-radius: 50x 50px 0 0;
    max-width: 90%;
    overflow-x: auto;
    display: block;
    background: white;
}

th, caption {
    font-family: <?= $font_family ?>;
    font-size: <?= $font_size ?>;
    background: <?= $header_teal ?>;
    color: #FFF;
    padding: 0.5rem 0.6rem;
    border-collapse: separate;
    border-bottom: <?= $dash_border?> #FFF;
}

td {
    font-family: <?= $font_family ?>;
    font-size: <?= $font_size ?>;
    border-bottom: <?= $std_border ?> #DDD;
    padding: 1rem 1.05rem;
    color: grey;
    text-align: center;
}

tr:nth-of-type(even) {
    background:  <?= $light_grey ?>;
}
tr:last-of-type {
    border-bottom: <?= $border_base ?> <?= $header_teal ?>;
}

form, section.input_container, .input_container_update {
    display: flex;
    flex-direction: rows;
    height: 50%;
    margin: auto;
    margin-bottom: 1rem;
}

div.admin_table_buttons {
    display: flex;
    flex-wrap: wrap;
    overflow-y: auto;

}

.table_button {
    display: inline;
    font-size: 20px;
    width: 100%;
    height: 50%;
    margin: auto;
    margin-bottom: 1rem;
    margin-inline: 0.5rem;
    text-align: center;
}

.create_button, .update_button {
    display: flex;
    font-size: 30px;
    margin: auto;
}

form.add_user_box {
    display: inline-block;
    flex-direction: column;
    flex-wrap: wrap;
}

form.add_user_box>* {
    flex: 1 1 2rem;
}

input.field, select.field, label, div.field_container, select {
    display: flex;
    flex-direction: rows;
    width: 95%;
    margin: auto;
}

input.field, select.field, div.field_container, select {
    height: 50%;
    margin-bottom: 1rem;
}

label {
    margin-bottom: 0.5rem;
}
filter {
    display:flex;
    flex-direction: column;
    margin: auto;
}


/* Hide spinners/arrows on number i */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}

/* Firefox */
input[type=number] {
-moz-appearance: textfield;
}

/* Mobile Media Queries */
@media only screen and (max-width: 768px) {
    body {
        max-width: 90%;
        background-image: url(<?= $bg_image_mobile ?>);
        background-position: center;
    }

    div.admin_table_buttons, form {
        width: 90%;
        display: inline-block;
    }    

    section.input_container, .input_container_update {
        width: 100%;
    }

    section.input_container_update {
        flex-wrap: wrap;
    }

    .table_button {
        font-size: 20px;
        height: 50px;
    }
}

/* Smaller Mobile Devices */
@media only screen and (max-width: 480px) {
    .table_button {
        font-size: 17px;
        width: 90%;
        height: 50px;
    }

    div.admin_table_buttons, form {
        width: 90%;
        display: inline-block;
        align-items: center;
    }  
}
