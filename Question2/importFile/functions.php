<?php
include_once("config.php");
if (isset($_POST["Import"])) {

    $filename = $_FILES["file"]["tmp_name"];
    $conn = getdb();
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sql = "INSERT into record (id,name,surname,initial,age, date_of_birth) 
                   values ('" . $getData[0] . "','" . $getData[1] . "','" . $getData[2] . "','" . $getData[3] . "','" . $getData[4] . "','" . $getData[5] . "')";
            $result = mysqli_query($conn, $sql);
            if (!isset($result)) {
                echo "<script type='text/javascript\'>
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";
            } else {
                echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"index.php\"
          </script>";
            }
        }
        fclose($file);
    }
}

function get_all_records()
{
    $conn = getdb();
    $Sql = "SELECT * FROM record";
    $result = mysqli_query($conn, $Sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>ID</th>
                          <th>Name</th>
                          <th>Surname</th>
                          <th>Initial</th>
                          <th>Age</th>
                          <th>Date Of Birth</th>
                        </tr></thead><tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['id'] . "</td>
                   <td>" . $row['name'] . "</td>
                   <td>" . $row['surname'] . "</td>
                   <td>" . $row['initial'] . "</td>
                   <td>" . $row['age'] . "</td>
                   <td>" . $row['date_of_birth'] . "</td>
                   </tr>";
        }

        echo "</tbody></table></div>";

    } else {
        echo "you have no records";
    }
}
?>