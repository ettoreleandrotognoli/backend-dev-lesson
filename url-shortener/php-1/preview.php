<?php
    $db = new PDO('sqlite:db.sqlite3');
    $urlCode = $_REQUEST['code'];
    $select = 'SELECT * FROM shorted_url WHERE code LIKE :code LIMIT 1';
    $stmt = $db->query($select);
    $stmt->bindValue(':code',$urlCode);
    $stmt->execute();
    $urls = $stmt->fetchAll();
    if(empty($urls)){
        header('HTTP/1.0 404 Not Found');
        die();
    }
    $baseUrl = 'localhost:8000';
    $shortedUrl = $urls[0];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Encurtador de URLs</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <br/>
        <div class="container">
            <div class="jumbotron">
                <h1>Encurtador de URLs</h1>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <a href="<?php echo 'http://',$baseUrl,'/',$shortedUrl['code'] ?>">
                            <h2>
                                <?php echo $baseUrl,'/',$shortedUrl['code'] ?>
                                <br/>
                                <small><?php echo $shortedUrl['url'] ?></small>
                            </h2>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <a href="/" class="btn btn-primary">Encurtar Outra</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

