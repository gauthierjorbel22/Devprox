 <?php
    function databaseConnect($id_number, $name, $surname, $date_of_birth)
    {
        //define database connection variables
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "devprox";


        $conn = mysqli_connect($servername, $username, $password, $db_name);

        // Check connection
        if ($conn === false) {
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        //prevent insertion of null value in database especially on page refresh
        if ($id_number == 0  || $name == "" || $surname == "" || $date_of_birth == "") {
            return;
        } else {
            $sql = "INSERT INTO user  VALUES ('$id_number',
            '$name','$surname','$date_of_birth')";
        }

        if (mysqli_query($conn, $sql)) {
            try {
                echo "<div class='alert alert-success m-5' role='alert'>data stored in user table successfully."
                    . " Please browse on your localhost php my admin"
                    . " to view the updated data</div>
                <div class='card m-5'>
                <ul class='list-group list-group-flush'>
                        <li class='list-group-item'>ID Number: $id_number</li>
                        <li class='list-group-item'>Name: $name</li>
                        <li class='list-group-item'>Surname: $surname</li>
                        <li class='list-group-item'>Date Of Birth: $date_of_birth</li> 
                    </ul>
                 </div>";
            } catch (ErrorException $e) {
                echo "Error: " . $e;
            }
        } else {
            echo "<div class='alert alert-danger m-5' role='alert'>ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn) . "</div>";
        }
        // Close connection
        mysqli_close($conn);
    }
    ?>
