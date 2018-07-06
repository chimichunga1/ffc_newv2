<?php

    if(filter_var($_POST['num'],FILTER_VALIDATE_FLOAT) && !empty($_POST['num'])){
        echo number_format((float)$_POST['num'],2,'.',',');
    }