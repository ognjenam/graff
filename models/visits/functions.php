<?php

function getVisits()
{
  global $conn;
  $query =  "SELECT * FROM visits";
  return $conn -> query($query) -> fetch();

}
