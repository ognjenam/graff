<?php

function catchErrors($error)
{
  $file = @ fopen (__DIR__."/errors.txt", "a");

  if($file)
  {
    $date = date("d/F/Y H:i:s");
    $data = $error . "\t" . $date . "\t\n";
    fwrite($file, $data);
    fclose($file);
  }
}
