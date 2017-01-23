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
        global $db;
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
            header(sprintf('Location: /preview/%s', $shortedUrl['code']));
            die();
        }
    }
    else{
        $errors = array();
    }
    include 'html/home.php';
