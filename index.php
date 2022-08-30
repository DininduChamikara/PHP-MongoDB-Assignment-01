<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script>
        function loadAlbums() {

            if (document.getElementById("demo").style.display == 'none') {
                document.getElementById("demo").style.display = 'block';
                document.getElementById('loadAlbumsBtn').innerText = 'Close Albums List'
            } else {
                document.getElementById("demo").style.display = 'none';
                document.getElementById('loadAlbumsBtn').innerText = 'Show Albums List'
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("demo").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", "getAlbums.php", true);
            xhttp.send();

        }
    </script>


</head>

<body>

    <?php
    if (file_exists('cd_catalog.xml')) {
        $xml = simplexml_load_file('cd_catalog.xml');
        // echo 'Successfully loaded';
    } else {
        exit('Failed to open cd_catalog.xml.');
    }
    // $client was defined in the config.php
    $albums = $client->selectCollection('WebAssignmentDB_test_1', 'cd_catalog_data');
    // echo "Collection albums from database WebAssignmentDB_test_1 selected";

    // Delete predefined data
    $deleteResult = $albums->deleteMany([]);
    // printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());

    // insert data to the mongoDB 
    foreach ($xml->CD as $cd) {
        $insertOneResult = $albums->insertOne([
            'title' => (string) $cd->TITLE,
            'artist' => (string) $cd->ARTIST,
            'country' => (string) $cd->COUNTRY,
            'company' => (string) $cd->COMPANY,
            'price' => (float) $cd->PRICE,
            'year' => (int) $cd->YEAR,
        ]);
    }
    ?>



    <div class="heading">
        <h1>All the times favourite</h1>
        <h1>Music Albums</h1>
    </div>

    <button id="loadAlbumsBtn" type="button" onclick="loadAlbums()">Show Albums List</button>
    <br><br>

    <span id="demo"></span>



    <a class="btn btn-primary" style="float:right" href="">Add New Album</a>



</body>

</html>