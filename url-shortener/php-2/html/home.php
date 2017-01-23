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
