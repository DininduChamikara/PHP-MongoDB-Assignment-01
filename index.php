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
    // $cd_albums = $albums->find([]);

    // foreach ($cd_albums as $cd_album) {
    //     echo $cd_album['title'];
    // ?>
    //     <br>
    // <?php
    // }

    ?>




    <br><br><br>

    <div class="heading">
        <h1>All the times favourite</h1>
        <h1>Music Albums</h1>
    </div>

    <a class="btn btn-primary" style="float:right" href="">Add New Album</a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Country</th>
                <th>Company</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cd_albums = $albums->find([]);
            foreach ($cd_albums as $cd_album) {
            ?>
                <tr>
                    <td><?php echo $cd_album['title'] . " (" . $cd_album['year'] . ")" ?></td>
                    <td><?php echo $cd_album['artist'] ?></td>
                    <td><?php echo $cd_album['country'] ?></td>
                    <td><?php echo $cd_album['company'] ?></td>
                    <td><?php echo "$ " . $cd_album['price'] ?></td>
                    <td><a class="btn btn-info" href="#">Edit</a>&nbsp;&nbsp; <a class="btn btn-danger" href="#">Delete</a></td>
                </tr>

            <?php
            }
            ?>
        </tbody>

    </table>

</body>

</html>