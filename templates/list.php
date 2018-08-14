<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 13/08/18
 * Time: 17:55
 */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>List of uploads</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>List of uploads</h1>
            </div>

            <ul class="list-group col-sm-6">
                <?php $uploads = file('php://stdin'); ?>
                <?php foreach ($uploads as $upload): ?>
                    <li class="list-group-item">
                        <?php echo $upload ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    </body>
</html>
