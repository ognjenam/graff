<?php

$word_file = new COM("Word.application");
$word_file -> Visible  = true;


$word_file -> Documents -> Add();
$word_file -> Selection -> TypeText("Ime i prezime: Ognjena Mihajlovic \n");
$word_file -> Selection -> TypeText("Broj indeksa: 40/17");
$word_file -> Documents[1] -> SaveAs("CV.doc");


$word_file -> Quit();
$word_file = null;


header("Location: ../../index.php");
