<?php
ini_set('memory_limit', 512000000);

$names = array(
    "Gauthier",
    "Maxime",
    "Chris",
    "Axel",
    "Prudence",
    "Patrick",
    "Sabia",
    "Anna",
    "Suhanna",
    "Sam",
    "Hugh",
    "Tyron",
    "Kess",
    "Kevin",
    "Hugo",
    "Kally",
    "Kaylen",
    "Mohammed",
    "Glody",
    "Jordan"
);

$surnames = array(
    "Kanku",
    "Dante",
    "Sanchez",
    "Lwala",
    "Nzoyisaba",
    "Mukad",
    "Sanderson",
    "Crams",
    "Aricum",
    "Roux",
    "Roux",
    "Martin",
    "Ulsman",
    "Steyn",
    "Ian",
    "James",
    "Serbia",
    "Sarah",
    "Scandal",
    "Napolis"
);

$people = array();
function generateRandomDetails($number_to_generate)
{
    for ($i = 0; $i < $number_to_generate; $i++) {
        $names = $GLOBALS['names'];
        $surnames = $GLOBALS['surnames'];
        $newNames = $names[rand(0, count($names) - 1)];
        $newSurnames = $surnames[rand(0, count($surnames) - 1)];
        // Generate a timestamp using mt_rand
        $timestamp = mt_rand(1, time());
        // Format that timestamp into a readable date string 
        $today = date("Y-m-d");
        $randomDate = date("d-m-Y", $timestamp);

        $diff = date_diff(date_create($randomDate), date_create($today));
        $people[] = ($i + 1) . "," . $newNames . "," . $newSurnames . "," . strval($newNames[0]) . "," . generateDate($diff) . "," . $randomDate;
    }
    return $people;
}


foreach ($people as $person) {
    echo ($person . "<br>");
}

// Generate age
function generateDate($diff)
{
    $diff->format("%y");
    return $diff->format("%y");
}

function createWriteFile($peopleArr)
{
    $path = "./output/output.csv";
    try {
        $file = fopen("./output/output.csv", 'w');
        if ($file === false) {
            die("Error opening the file " . "output.csv");
        }
        // Write each row at a time to a file
        foreach ($peopleArr as $person) {
            fputcsv($file, explode(',', $person));
        }
        // Close the file 
        fclose($file);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
// createWriteFile();
