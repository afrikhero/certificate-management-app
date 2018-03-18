<?php

try {
  $db_connection = new PDO('mysql:host=127.0.0.1;dbname=certificates', 'root', 'noble555666888');
} catch (Exception $e) {
  die($e->getMessage());
}
$db_connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!empty($_GET['id'])) {
  $query = 'SELECT * FROM issuedCert WHERE id = :id';
  $query = $db_connection->prepare($query);
  $params = [
    'id' => $_GET['id']
  ];
  $query->execute($params);
  if ($query->fetch()) {
    echo 'false';
  } else{
    echo 'true';
  }
}
