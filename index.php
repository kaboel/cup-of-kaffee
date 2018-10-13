<?php
require('lib/conn.php');

$conn = new Conn;
if(!$conn->conn()) {
    echo "False";
} else {
    echo "True";
}
?>