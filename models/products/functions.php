<?php
  function getProducts()
  {
    return "SELECT * from products";
  }
  function getProductsWithCategory()
  {
    global $conn;
    $query =  "SELECT p.*, c.name as catName from products p INNER JOIN categories c ON c.category_ID = p.category_ID";
    return $conn -> query($query) -> fetchAll();
  }

  function productsImages()
  {
    return "SELECT * FROM products LIMIT 0, 4";
  }

  function countProducts()
  {
    global $conn;
    $query =  "SELECT COUNT(*) as total FROM products";
    return $conn -> query($query) -> fetch();
  }

  function filterProductModal($prod_id)
  {
    global $conn;
    $query = $conn -> prepare("SELECT p.*, c.name as nameCat FROM products p INNER JOIN categories c ON p.category_ID=c.category_ID where product_ID = ?");
    $query -> execute([$prod_id]);
    return $query -> fetch();
  }

  function filterSearch($value)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * FROM products WHERE LOWER(name) LIKE ?");
    $query -> execute([$value]);
    return $query -> fetchAll();
  }

  function productByCategory($cat)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * FROM products WHERE category_ID = ?");
    $query -> execute([$cat]);
    return $query -> fetchAll();
  }

  function pagination($page)
  {
    global $conn;
    $query = $conn -> prepare("SELECT p.*, c.name as catName FROM products p
      INNER JOIN categories c ON  p.category_id = c.category_ID ORDER BY p.product_ID LIMIT $page,4");
    $query -> execute([$page]);
    return $query -> fetchAll();
  }
  function updateNameProduct($prod_name, $prod_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE products SET name = ? WHERE product_ID  = ?");
    $query -> execute([$prod_name, $prod_id]);
    return true;
  }
  function deleteProduct($prod_id)
  {
    global $conn;
    $query = $conn -> prepare("DELETE FROM products WHERE product_ID = ?");
    $query -> execute([$prod_id]);
    return true;
  }

  function categoryByProduct($prod_id)
  {
    global $conn;
    $query = $conn -> prepare("SELECT c.name as catName, p.* FROM categories c INNER JOIN products p on c.category_id=p.category_id where product_ID = ?");
    $query -> execute([$prod_id]);
    return $query -> fetch();
  }

  function allAboutProduct($prod_id)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * FROM products where product_ID = ?");
    $query -> execute([$prod_id]);
    return $query -> fetch();
  }


  function insertProduct($_name, $_price, $_old_price, $_color, $db_small_img_name, $db_big_img_name, $_descr, $_category_id)
  {
    global $conn;
    $query = $conn -> prepare("INSERT INTO products VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query -> execute([$_name, $_price, $_old_price, $_color, $db_small_img_name, $db_big_img_name, $_descr, $_category_id]);
    return true;
  }
  function updateProduct($_name, $_price, $_old_price, $_color, $db_small_img_name, $db_big_img_name, $_descr, $_category_id, $prod_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE products SET name = ?, price = ?, price_old = ?, color = ?, image = ?, image_big = ?, description = ?, category_ID = ? WHERE product_ID  = ?");
    $query -> execute([$_name, $_price, $_old_price, $_color, $db_small_img_name, $db_big_img_name, $_descr, $_category_id, $prod_id]);
    return true;
  }
