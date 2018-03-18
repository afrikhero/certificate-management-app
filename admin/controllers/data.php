<?php
// Get job (and id)
$job = '';
$id  = '';
if (isset($_GET['job'])){
  $job = $_GET['job'];
  if ($job == 'get_companies' ||
      $job == 'get_company'   ||
      $job == 'add_company'   ||
      $job == 'edit_company'  ||
      $job == 'delete_company'){
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      if (!is_numeric($id)){
        $id = '';
      }
    }
  } else {
    $job = '';
  }
}
// Prepare array
$mysql_data = array();
// Valid job found
if ($job != ''){
  // Connect to database using PDO
  try {
    $db_connection = new PDO('mysql:host=127.0.0.1;dbname=certificates', 'root', 'noble555666888');
  } catch (PDOException $e) {
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  };
  $db_connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  // Execute job
  if ($job == 'get_companies'){
    // Get companies
    $query = 'SELECT * FROM issuedCert ORDER BY serial ASC';
    $query = $db_connection->prepare($query);
    $query->execute();
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = $query->fetch()){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['id'] . '" data-name="' . $company['name'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['id'] . '" data-name="' . $company['name'] . '"><span>Delete</span></a></li>';
        $functions .= '</ul></div>';
        $mysql_data[] = array(
          "serial"          => $company['serial'],
          "name"  => $company['name'],
          "id"    => $company['id'],
          "course" => $company['course'],
          "date"   => $company['date'],
          "functions"     => $functions
        );
      }
    }
  } elseif ($job == 'get_company'){
    // Get company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "SELECT * FROM issuedCert WHERE id = :id";
      $query = $db_connection->prepare($query);
      $params = [
        'id' => $_GET['id']
      ];
      $query->execute($params);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = $query->fetch()){
          $mysql_data[] = array(
            "name"  => $row['name'],
            "id"    => $row['id'],
            "course"       => $row['course'],
            "date"   => $row['date']
          );
        }
      }
    }
  } elseif ($job == 'add_company'){
    // Add company
    $query = 'INSERT INTO issuedCert (name, id, course, date) VALUES (:name, :id, :course, :date)';
    $statement = $db_connection->prepare($query);
    $params = [
      'name' => $_GET['name'],
      'id' => $_GET['id'],
      'course' => $_GET['course'],
      'date' => $_GET['date']
    ];
    $statement->execute($params);
    if (!$statement){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
    }
  } elseif ($job == 'edit_company'){
    // Edit company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "UPDATE issuedCert SET name = :name, id = :id, course = :course, date = :date WHERE id = :id";
      $query = $db_connection->prepare($query);
      $params = [
        'name' => $_GET['name'],
        'id' => $_GET['id'],
        'course' => $_GET['course'],
        'date' => $_GET['date']
      ];
      $query->execute($params);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
  } elseif ($job == 'delete_company'){
    // Delete company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "DELETE FROM issuedCert WHERE id = :id";
      $query = $db_connection->prepare($query);
      $params = [
        'id' => $_GET['id']
      ];
      $query->execute($params);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
  }
}
// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);
// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;
?>
