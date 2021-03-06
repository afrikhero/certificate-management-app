<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <title>Manage Certificate Records</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1000, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>

    <div id="page_container">

      <h1>Certificates Issued By IAMPS</h1>

      <button type="button" class="button" id="add_company">Add Certificate</button>

      <table class="datatable" id="table_companies">
        <thead>
          <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Certificate ID</th>
            <th>Course</th>
            <th>Date</th>
            <th>Functions</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    </div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">

        <h2>Add Certificate</h2>
        <form class="form add" id="form_company" data-id="" novalidate>
          <div class="input_container">
            <label for="name">Name: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="name" id="name" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="id">Certificate ID: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" class="text" name="id" id="id" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="course">Course: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="course" id="course" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="date">Date: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="date" id="date" value="" required>
            </div>
          </div>
          <div class="button_container">
            <button type="submit">Add Certificate</button>
          </div>
        </form>

      </div>
    </div>

    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
            Loading, please wait...
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script charset="utf-8" src="https://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="../js/webapp.js"></script>
  </body>
</html>
