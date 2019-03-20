<?php
$mysqli = new mysqli('localhost:3306', 'pilotplan', 'pilotplan', 'pilotplan'); if ($mysqli->connect_errno) {
   echo "Sorry, this website is experiencing problems.<p>";
   echo "Error: Failed to make a MySQL connection, here is why: <br>";
   echo "Errno: " . $mysqli->connect_errno . "<br>";
   echo "Error: " . $mysqli->connect_error . "<br>";
   exit;
}

echo "Wooohoooo it works with PHP" . phpversion() ."!!<br><hr>";

