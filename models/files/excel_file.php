<?php
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/functions.php");

  $products = getProductsWithCategory();

  $excel_file = new COM("Excel.Application");
  $excel_file -> Visible = true;
  $excel_file -> DisplayAlerts = 1;

  $workbook = $excel_file -> Workbooks -> Add();
  $worksheet = $excel_file -> Worksheets("Sheet1");
  $worksheet -> activate;


  $name = $worksheet -> Range("A1");
  $name -> activate;
  $name -> Value = "Name";

  $price = $worksheet -> Range("B1");
  $price -> activate;
  $price -> Value = "Price";

  $price_old = $worksheet -> Range("C1");
  $price_old -> activate;
  $price_old -> Value = "Price old";

  $color = $worksheet -> Range("D1");
  $color -> activate;
  $color -> Value = "Color";

  $img_small = $worksheet -> Range("E1");
  $img_small -> activate;
  $img_small -> Value = "Image small";

  $img_big = $worksheet -> Range("F1");
  $img_big -> activate;
  $img_big -> Value = "Image big";

  $descr = $worksheet -> Range("G1");
  $descr -> activate;
  $descr -> Value = "Description";

  $category = $worksheet -> Range("H1");
  $category -> activate;
  $category -> Value = "Category";

  $counter = 1;
  foreach($products as $p)
  {
      $cell_name = $worksheet -> Range("A{$counter}");
      $cell_name -> activate;
      $cell_name -> Value = $p -> name;

      $cell_price = $worksheet -> Range("B{$counter}");
      $cell_price -> activate;
      $cell_price -> Value = $p -> price;

      $cell_old_price = $worksheet -> Range("C{$counter}");
      $cell_old_price -> activate;
      $cell_old_price -> Value = $p -> price_old;

      $cell_color = $worksheet -> Range("D{$counter}");
      $cell_color -> activate;
      $cell_color -> Value = $p -> color;

      $cell_small_img = $worksheet -> Range("E{$counter}");
      $cell_small_img -> activate;
      $cell_small_img -> Value = $p -> image;

      $cell_big_img = $worksheet -> Range("F{$counter}");
      $cell_big_img -> activate;
      $cell_big_img -> Value = $p -> image_big;

      $cell_descr = $worksheet -> Range("G$counter");
      $cell_descr -> activate;
      $cell_descr -> Value = $p -> description;

      $category = $worksheet -> Range("H$counter");
      $category -> activate;
      $category -> Value = $p -> catName;

      $counter++;
  }

  $count_products = $worksheet -> Range("I1");
  $count_products -> activate;
  $count_products -> Value = count($products);

$workbook -> _SaveAs("products");

$workbook -> Saved = true;
$workbook -> Save();
$workbook -> Close;

$excel_file -> Workbooks -> Close();
$excel_file -> Quit();

unset($workbook);
unset($worksheet);
unset($excel_file);



header("Location: ../../index.php");
