<?php
    function checkUrl($url){
        if(empty($url)){
            throw new Exception('O campo URL é requerido');
        }
        return true;
    }

    function valid(){
        $rules = array('url'=>'checkUrl');
        $errors = array();
        foreach ($rules as $key => $value) {
            try{
                $value($_REQUEST[$key]);
            }
            catch(Exception $ex){
                $errors[$key] = $ex->getMessage();
            }
        }
        return $errors;
    }

    function shorten($url){
        $db = new PDO('sqlite:db.sqlite3');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $nextId = $db->query('SELECT COALESCE(MAX(id),0) + 1 AS nextId FROM shorted_url')->fetchAll()[0][0];
        if(strrpos($url, '://') === false){
            $url = 'http://'.$url;
        }
        $shortedUrl = array(
            'url' => $url,
            'code' => base_convert((int)$nextId,10,36)
        );
        $insert = 'INSERT INTO shorted_url(url,code) VALUES (:url,:code)';
        $stmt = $db->prepare($insert);
        foreach ($shortedUrl as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }
        $stmt->execute();
        return $shortedUrl;
    }

    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST') {
        $errors = valid();
        if(empty($errors)){
            $shortedUrl = shorten($_REQUEST['url']);
            header(sprintf('Location: /preview.php?code=%s', $shortedUrl['code']));
            die();
        }
    }
    else if($method == 'GET' && $_SERVER['REQUEST_URI'] !== '/'){
        $code = substr($_SERVER['REQUEST_URI'],1);
        $db = new PDO('sqlite:db.sqlite3');
        $select = 'SELECT * FROM shorted_url WHERE code LIKE :code LIMIT 1';
        $stmt = $db->query($select);
        $stmt->bindValue(':code',$code);
        $stmt->execute();
        $urls = $stmt->fetchAll();
        if(empty($urls)){
            header('HTTP/1.0 404 Not Found');
            die();
        }
        $shortedUrl = $urls[0];
        header(sprintf('Location: %s',$shortedUrl['url']));
        die();
    }
    else{
        $errors = array();
    }
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
            <form action="/" method="POST">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        Por favor verique os erros.
                    </div>
                <?php endif; ?>
                <div class="form-group <?php if(key_exists('url', $errors)): ?> has-error <?php endif; ?>" >
                    <label class="control-label" for="url">URL:</label>                    
                    <input class="form-control" id="url" name="url" type="text" value="<?php echo $_REQUEST['url'] ?>"></input>
                    <?php if(key_exists('url',$errors)): ?>
                        <span class="error text-danger"><?php echo $errors['url'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Encurtar</button>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>
