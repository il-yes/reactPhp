<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 14/08/18
 * Time: 09:15
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ReactPHP App</title>
    <!-- Minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        body { padding-top: 50px };
        li {overflow: -webkit-paged-x};
        .img-view img{height:100% !important;}
        ul li{ overflow: overlay;}
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="row">
            <a href="about" class="btn btn-primary pull-right">A propos</a>
        </div>
        <div class="col-sm-12">
            <h1>Main page with reactPhp</h1><em>Uploads</em>
        </div>
        <!-- Form -->
        <div class="col-sm-12">
            <form action="/upload" method="POST" enctype="multipart/form-data" class="justify-content-center">
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea name="text" id="text" rows="3" cols="60" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input name="file" id="file" type="file" accept="image/x-png, image/jpeg"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <!-- Views -->
        <div class="col-sm-12">
            <hr>
            <h3>Already uploaded:</h3>
            <?php  $uploads = file('php://stdin'); ?>
            <?php if (empty($uploads)): ?>
                No files.
            <?php else: ?>
                <ul class="list-group col-sm-6">
                    <?php foreach ($uploads as $upload): ?>
                        <li class="list-group-item">
                            <img class="col-sm-2" src="previews/<?php echo $upload ?>">
                            <span class="img-name">
                                <a href="/previews/<?php echo $upload ?>" target="_blank"><?php echo $upload ?></a>
                            </span>

                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

    </div>
</div>
</body>
</html>
