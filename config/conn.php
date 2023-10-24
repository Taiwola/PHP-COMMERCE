<?php

try {
    $conn = mysqli_connect('localhost', 'root', '', 'mystore');
} catch (mysqli_sql_exception) {
    echo "not connected";
}
