<?php
$connection = mysqli_connect(getenv('DB_HOSTNAME'),getenv('DB_USERNAME'),getenv('DB_PASSWORD'));
if ($connection) {
    echo "ok";
}