<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printers Generator - File I/O</title>
    <link rel="stylesheet" href="css/printersGen.css">
</head>
<body><?php

//Initialize array variables
$ipAddresses = array(); //store the ip address of the printer by its hostname associative array.
$printerTypes = [];
$buildings = [];
$roomNumbers = [];
$buildingNumPrinters = [];

//Establish a connection to the file by opening it.
//Connections are often referred to as file handles, file descriptors, nicknames, etc...
$fp = fopen("printers.txt", "r");

//read the file line-byline
while (!feof($fp)){

    //fgets($fp) reads the line of data pointed to by the file pointer $sfp including
    //its ending \n newline character and returns the line as a string. It also then updates the file pointer
    //to point to the next line in the file.
    $printerLine = rtrim(fgets($fp));

    if ($printerLine != "") {
       // echo "<h3>The red line is $printerLine</h3>";

        //Break up the line of data into individual fields
        list($ip, $hostName, $brand, $buildingName, $roomNum) = explode(",", $printerLine);

        // Lets use the arrays we set up earlier to store the data
        // from each input line so we can access it latter

        //these are associative arrays that will use the hostname of the printer as thier keys

        $ipAddresses[$hostName] = $ip;
        $printerTypes[$hostName] = $brand;
        $buildings[$hostName] = $buildingName;
        $roomNumbers[$hostName] = $roomNum;

        //Also store the building names uniquely as keys in the $buildingNumPrinters array
        //where the value of each element in this array will represent the number
        //of printers in that building.
        if (!isset($buildingNumPrinters[$buildingName])) {
            $buildingNumPrinters[$buildingName] = 0;
        }
            $buildingNumPrinters[$buildingName]++;

    } //end if NOT EOF

} //end while NOT EOF

/*
echo "Number of printers = " . count($ipAddresses) . "<br>";

print_r($ipAddresses);

echo "<br><br>";
print_r($buildingNumPrinters);
*/

//We've finished reading our input data and we have stored all of the data in
//associative indexed arrays, so lets start producing our output.

//For each building, produce a table showing the number of printers in the building and
//produce a table row in that table for each printer in the building. Each row will
//show the printer's information in its cells.
/*
 foreach building
  print table
  foreach printer (row)
   print row for printer
 */
foreach ($buildingNumPrinters as $buildingName => $numPrinters){

    ?>
    <table>

        <tr class="firstRow">
            <th colspan="3">
                <span class="headerTxt"><?= $buildingName ?></span>
            </th>
            <th># of printers = <?= $numPrinters ?></th>
        </tr><?php
        //For each printer in this building, produce a table row with the printers
        //information in each cell of the row.
        foreach ($buildings as $printerName => $printerBuilding){

            //create a table row for this printer only if the printer is in our
            //current tables building
            if($printerBuilding == $buildingName){

                //add this printer as a row in this table and color code its
                //cell background color based on the type of printer it is
                if ($printerTypes[$printerName] == "Lexmark"){
                    $className = 'lexmark';
                } else if ($printerTypes[$printerName] == "HP LaserJet"){
                    $className = 'laserJet';
                } else if ($printerTypes[$printerName] == "Epson"){
                    $className = 'epson';
                } else {
                    $className = 'other';
                }
                ?>
        <tr>
            <td class="<?= $className ?>"><?= $printerName ?></td>
            <td class=""><?= $ipAddresses[$printerName] ?></td>
            <td class=""><?= $printerTypes[$printerName] ?></td>
            <td class=""><?= $roomNumbers[$printerName] ?></td>
        </tr><?php

            }

        } //end inner for each printer in this building
?>  </table><?php
} // end outer foreach building

?>

</body>
</html>
