<?php


interface MessageSender {

    public function emailSend($email,$message);

    public function smsSend($phone, $message);

    public function telegramSend($telegramId,$message);

}


class MyMessageSender implements MessageSender{

    public function emailSend($email,$message){
        mail($email,'PHP Mail',$message);
    }

    public function smsSend($phone,$message){
        $ch = curl_init();
        $tokenPublic = 'pos-univem';
        $tokenSecret = 'ettoreleandrotognoli';
        $url = 'https://smscommunity.herokuapp.com/sms/%s/?token_public=%s&token_secret=%s';
        curl_setopt($ch, CURLOPT_URL, sprintf($url,$phone,$tokenPublic,$tokenSecret));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
        $serverOutput = curl_exec($ch);
        curl_close ($ch);
    }

    public function telegramSend($telegramId,$message){
        echo shell_exec(sprintf('telegram-cli -RD -e "msg %s %s"',$telegramId,$message)."\n");
    }

}

$sender = new MyMessageSender();
$sender->emailSend('ettore.leandro.tognoli@gmail.com','PosUnivem');
$sender->smsSend('998574757','PosUnivem');
$sender->telegramSend('Éttore_Leandro_Tognoli','PosUnivem');
