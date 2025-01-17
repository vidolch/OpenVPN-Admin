<?php

  function getMigrationSchemas() {
    return [ 0 ];
  }

  function updateUserFlag($bdd, $userId, $field, $value) {
    $req_string = 'UPDATE user SET ' . $field . ' = ? WHERE user_id = ?';
    $req = $bdd->prepare($req_string);
    $req->execute(array($value, $userId));
  }
  function updateSchema($bdd, $newKey) {
    if ($newKey === 0) {
      $req_string = 'INSERT INTO `application` (sql_schema) VALUES (?)';
    }
    else {
      $req_string = 'UPDATE `application` SET `sql_schema` = ?';
    }

    $req = $bdd->prepare($req_string);
    $req->execute(array($newKey));
  }

  function printError($str) {
    echo '<div class="alert alert-danger" role="alert">' . $str . '</div>';
  }

  function printSuccess($str) {
    echo '<div class="alert alert-success" role="alert">' . $str . '</div>';
  }

  function isInstalled($bdd) {
    $req = $bdd->prepare("SHOW TABLES LIKE 'admin'");
    $req->execute();

    if(!$req->fetch())
      return false;

    return true;
  }
  function generateSecretCode() {
    $val = '';
    for( $i=0; $i<16; $i++ ) {
       $val .= chr( rand( 65, 90 ) );
    }
    return $val;
  }
  function hashPass($pass) {
    return password_hash($pass, PASSWORD_DEFAULT);
  }

  function passEqual($pass, $hash) {
    return password_verify($pass, $hash);
  }

?>
