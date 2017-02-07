<?php


interface MessageSender {

    public function send($id,$message);

}

class TelegramSender implements MessageSender{
    public function send($telegramId,$message){
        echo shell_exec(sprintf('telegram-cli -RD -e "msg %s %s"',$telegramId,$message)."\n");
    }
}

class EMailSender implements MessageSender{
    public function send($email,$message){
        mail($email,'PHP Mail',$message);
    }
}

class SMSSender implements MessageSender{
    public function send($phone,$message){
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
}


(new EMailSender())->send('ettore.leandro.tognoli@gmail.com','PosUnivem');
(new SMSSender())->send('998574757','PosUnivem');
(new TelegramSender())->send('Éttore_Leandro_Tognoli','PosUnivem');
