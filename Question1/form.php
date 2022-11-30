<!DOCTYPE HTML>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <title>Question 1</title>

  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body>

  <?php
  require_once "db.php";
  // define variables and set to empty values
  $name = "";
  $email = "";
  $gender = "";
  $comment = "";
  $website = "";
  //define errors variables 
  $nameErr = $surnameErr = $id_numberErr = $date_of_birthErr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) {
      $nameErr = "Only letters and white space allowed";
    } else {
      $name = validate_input($_POST["name"]);
    }

    if (empty($_POST["surname"])) {
      $surnameErr = "Email is required";
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["surname"])) {
      $surnameErr = "Only letters and white space allowed";
    } else {
      $surname = validate_input($_POST["surname"]);
    }

    if (empty($_POST["id_number"])) {
      $id_numberErr = "ID Number is required";
    } else {
      if (strlen((string)validate_input($_POST["id_number"]))  != 13) {
        $id_numberErr = "ID must be 13 characters long";
      } else {
        $id_number = validate_input($_POST["id_number"]);
      }
    }
    if (empty($_POST["date_of_birth"])) {
      $date_of_birthErr = "Date Of Birth is required";
    } else {
      $initial_dob = validate_input($_POST["date_of_birth"]);
      $date_of_birth = date("d-m-Y", strtotime($initial_dob)); //changed data from mm-dd-yyyy to dd-mm-yyyy
    }
  }

  function validate_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
  <div class="container">
    <form class="p-5 mt-5 text-bg-dark" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h2 class="p-5">DATA MANAGEMENT SYSTEM</h2>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name">
        <span class="error">* <?php echo $nameErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="surname" class="form-label">Surname</label>
        <input type="text" name="surname" class="form-control" placeholder="Surname">
        <span class="error">* <?php echo $surnameErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="id_number" class="form-label">ID Number</label>
        <input type="number" name="id_number" class="form-control" placeholder="Enter ID Number">
        <span class="error">* <?php echo $id_numberErr; ?></span>
      </div>
      <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date Of Birth</label>
        <input type="date" name="date_of_birth" class="form-control" placeholder="Date Of Birth">
        <span class="error">* <?php echo $date_of_birthErr; ?></span>
      </div>
      <input class="btn btn-success" type="submit" name="submit" value="Submit">
      <input class="btn btn-danger" type="submit" name="Cancel" value="Cancel">
    </form>

    <?php
    databaseConnect($id_number, $name, $surname, $date_of_birth);
    ?>
  </div>
</body>

</html>