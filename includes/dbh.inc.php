<?php

$servername = "localhost";
$dBUsername ="root";
$dBPassword = "";
$dBName = "systemlogin";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

// Checks if our connection was sucessfull or not if it failed then we throw out the error

if (!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}
