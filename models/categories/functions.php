<?php

  function getCategories()
  {
    return "SELECT * from categories";
  }

  function getMenuItems()
  {
    return "SELECT * from menu";
  }

  function getCategoryById($id)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * from categories WHERE category_ID = ?");
    $query -> execute([$id]);
    return $query -> fetch();
  }

  function updateNameCategory($cat_name, $cat_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE categories SET name = ? WHERE category_ID  = ?");
    $query -> execute([$cat_name, $cat_id]);
    return true;
  }

  function deleteCategoryById($id)
  {
    global $conn;
    $query = $conn -> prepare("DELETE from categories WHERE category_ID = ?");
    $query -> execute([$id]);
  }
  function addCategory($name)
  {
    global $conn;
    $query = $conn -> prepare("INSERT INTO categories values (NULL, ?)");
    $query -> execute([$name]);
  }
