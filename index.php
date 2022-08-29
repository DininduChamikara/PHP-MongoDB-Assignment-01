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
</head>

<body>
    <h1>Test Heading</h1>
    <?php
    if (file_exists('cd_catalog.xml')) {
        $xml = simplexml_load_file('cd_catalog.xml');
        echo 'Successfully loaded';
    } else {
        exit('Failed to open cd_catalog.xml.');
    }
    // $client was defined in the config.php
    $albums = $client->selectCollection('WebAssignmentDB_test_1', 'cd_catalog_data');
    echo "Collection albums from database WebAssignmentDB_test_1 selected";

    // Delete predefined data
    $deleteResult = $albums->deleteMany([]);
    printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());

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

    <br>

    <?php
    $cd_albums = $albums->find([]);

    foreach ($cd_albums as $cd_album) {
        echo $cd_album['title'];
    ?>
        <br>
    <?php
    }

    ?>

</body>

</html>