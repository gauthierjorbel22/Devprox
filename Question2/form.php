<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <title>Generate CSV</title>
</head>

<body>
    <?php
    require_once "index.php";
    $name = "Gauthier";
    $number_to_generate = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            $number_to_generate = validate_input($_POST["number_to_generate"]);
        }
    }
    function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $peopleArr = generateRandomDetails($number_to_generate);

    generateRandomDetails($number_to_generate);
    createWriteFile($peopleArr);
    ?>
    <div class="container">
        <form class="p-5 mt-5 text-bg-dark" method="post"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2 class="p-5">CSV Generator</h2>
            <div class="mb-3">
                <label for="number_to_generate" class="form-label">Enter Number of Record You want to generate</label>
                <input type="number" name="number_to_generate" class="form-control" placeholder="Enter Number" required>
                <input class="btn btn-success mt-5" type="submit" name="submit" value="Submit">
            </div>
        </form>
        <div class="alert alert-success" role="alert">
            Number of record:
            <?php echo $number_to_generate ?>
        </div>
        <div class="container">
            <p>
                <?php generateRandomDetails($number_to_generate);
                createWriteFile($peopleArr);
                ?>
            </p>
        </div>
    </div>

</body>

</html>