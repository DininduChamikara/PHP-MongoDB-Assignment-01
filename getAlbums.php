<?php
include 'config.php';

$albums = $client->selectCollection('WebAssignmentDB_test_1', 'cd_catalog_data');
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