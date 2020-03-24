<?php
  function userByEmail($email)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * from users where e_mail = ?");
    $query -> execute([$email]);
    return $query -> fetch();
  }
  function userNameById($user_ID)
  {
    global $conn;
    $query = $conn -> prepare("SELECT username from users where user_ID = ?");
    $query -> execute([$user_ID]);
    return $query -> fetch();
  }

  function userByEmailAndPass($email, $password)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * from users WHERE e_mail = ? and password = ?");
    $query -> execute([$email, $password]);
    return $query;
  }
  function userById($user_id)
  {
    global $conn;
    $query = $conn -> prepare("SELECT u.*, r.name as roleName from users u INNER JOIN roles r ON u.role_ID = r.role_ID WHERE user_ID = ?");
    $query -> execute([$user_id]);
    return $query -> fetch();
  }

  function lastVisit($date, $user_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE users SET last_visit = ?, active = 1 WHERE user_ID = ?");
    $query -> execute([$date, $user_id]);

  }

  function logout($user_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE users SET active = 0 WHERE user_ID = ?");
    $query -> execute([$user_id]);

  }

  function userByUsername($username)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * from users where username = ?");
    $query -> execute([$username]);
    return $query -> fetch();
  }

  function addNewUser($username, $email, $password)
  {
    $date = date("Y-m-d H:i:s");
    global $conn;
    $query = $conn -> prepare("INSERT INTO users VALUES(NULL,?,?,?,0,?,0,2)");
    $query -> execute([$username, $email, md5($password), $date]);
  }

  function getUsers()
  {
    global $conn;
    $query = $conn -> prepare("SELECT u.*, r.name as role, r.role_ID as roleID from users u INNER JOIN roles r ON u.role_ID = r.role_ID");
    $query -> execute();
    return $query -> fetchAll();
  }

  function updateUserRole($role_ID,$user_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE users SET role_ID = ? WHERE user_ID = ?");
    $query -> execute([$role_ID, $user_id]);
    return true;
  }

  function getRoleId($role_val)
  {
    global $conn;
    $query = $conn -> prepare("SELECT * from roles where name LIKE ?");
    $query -> execute([$role_val]);
    return $query -> fetch();
  }

  function loginError($user_ID)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE users SET log_error = log_error + 1 WHERE user_ID = ?");
    $query -> execute([$user_ID]);
    // return true;
  }
  function counterError($user_ID)
  {
    global $conn;
    $query = $conn -> prepare("SELECT log_error FROM users WHERE user_ID = ?");
    $query -> execute([$user_ID]);
    return $query -> fetch();
  }
  function updateErrorPass($user_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE users SET log_error = 0 WHERE user_ID = ?");
    $query -> execute([$user_id]);
    return true;

  }
  function changedPass($pass, $user_id)
  {
    global $conn;
    $query = $conn -> prepare("UPDATE users SET password = ? WHERE user_ID = ?");
    $query -> execute([md5($pass), $user_id]);
    return true;

  }
