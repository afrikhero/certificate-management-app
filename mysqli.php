<?php
// Database details
/*
$db_server   = '127.0.0.1';
$db_username = 'root';
$db_password = 'noble555666888';
$db_name     = 'certificates';
*/

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

  // Connect to database
  $db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }
  try {
    $db_connection = new PDO('mysql:host=127.0.0.1;dbname=certificates', 'root', 'noble555666888');

  } catch (PDOException $e) {
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  };

  $dbConnect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  // Execute job
  if ($job == 'get_companies'){

    // Get companies
    $query = "SELECT * FROM issuedCert";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
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
      $query = "SELECT * FROM issuedCert WHERE id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
            "serial"          => $company['serial'],
            "name"  => $company['name'],
            "id"    => $company['id'],
            "course"       => $company['course'],
            "date"   => $company['date']
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
      $query = "UPDATE issuedCert SET ";
      if (isset($_GET['name']))         { $query .= "name         = '" . mysqli_real_escape_string($db_connection, $_GET['name'])         . "', "; }
      if (isset($_GET['id'])) { $query .= "id = '" . mysqli_real_escape_string($db_connection, $_GET['id']) . "', "; }
      if (isset($_GET['course']))   { $query .= "course   = '" . mysqli_real_escape_string($db_connection, $_GET['course'])   . "', "; }
      if (isset($_GET['date']))      { $query .= "date      = '" . mysqli_real_escape_string($db_connection, $_GET['date'])      . "', "; }
      $query .= "WHERE id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query  = mysqli_query($db_connection, $query);
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
      $query = "DELETE FROM issuedCert WHERE id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }

  }

  // Close database connection
  mysqli_close($db_connection);

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

