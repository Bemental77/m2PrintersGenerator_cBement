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
    
}

?>

</body>
</html>
