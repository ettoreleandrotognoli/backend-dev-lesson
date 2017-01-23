<?php

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
