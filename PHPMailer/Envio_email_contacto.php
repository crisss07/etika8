<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of envio_password
 *
 * @author mikael
 */
class Envio_email_contacto {

    private $mailer = "";
    private $username = "";
    private $password = "";
    private $host = "";
    private $port = "";
    private $protocol = "";
    private $sslTls = "";

    public function __construct($mailer) {
        $this->setMailer($mailer);
        $this->setHost("mail.etika.net.bo");
        $this->setUsername("contactoetika@etika.net.bo");
        $this->setPassword("3t1k9srl2019");
        $this->setPort(25);
        $this->setSslTls("tls");
        $this->setProtocol("http://");


    }

    public function recuperar_contrasena($oMail, $emailDestino, $nombre_postulante, $asunto, $mensaje) {

        $oMail->isSMTP();
        // $oMail->Host="etika.net.bo";
        $oMail->Host="smtp.gmail.com";
        // $oMail->Port=25;
        $oMail->Port=587;
        $oMail->SMTPSecure='tls';
        $oMail->SMTPAuth=true;
        $oMail->SMTPAutoTLS = false;
        $oMail->SMTPKeepAlive = true;
        // $oMail->Username="seleccion2@etika.net.bo";
        $oMail->Username="sisetika@gmail.com";
        // $oMail->Username="controlbole@etika.net.bo";
        // $oMail->Password="seleccion2021";
        // $oMail->Password="ewbcczrzqacomnku";
        $oMail->Password="tvfxytqgqswhzomc";
        // $oMail->Password="dibel123";
        $oMail->CharSet = 'UTF-8';
        // $oMail->SMTPDebug = true; 
        $oMail->setFrom("sisetika@gmail.com", "ETIKA");
        $oMail->addAddress($emailDestino, $nombre_postulante);
        // $oMail->addAddress('rsecko@dibeltecnologia.com', $nombre_postulante);
        $oMail->Subject=$asunto;
        $oMail->msgHTML($mensaje);
        $oMail->isHTML(true);
        $oMail->SMTPOptions = array(
                                    'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                    )
                                    );

        if(!$oMail->send()){
            echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $oMail->ErrorInfo;
        }else{
            // echo 'Message has been sent';
        }

        // if(!$oMail->send()){
        //     return $oMail->ErrorInfo; 
        // } else {
        //     return 1;
        // }

        // $oMail= new PHPMailer();
        // $oMail->isSMTP();
        // $oMail->Host="smtp.gmail.com";
        // $oMail->Port=587;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="sjosefer07@gmail.com";
        // $oMail->Password="ewbcczrzqacomnku";
        // $oMail->CharSet = 'UTF-8';
        // $oMail->setFrom("sjosefer07@gmail.com", "Cristian Salinas");
        // $oMail->addAddress($emailDestino, $nombre_postulante);
        // $oMail->Subject=$asunto;
        // $oMail->msgHTML($mensaje);

        // if(!$oMail->send()){
        //     return $oMail->ErrorInfo; 
        // } else {
        //     return 1;
        // }

        // $email_envio = "seleccion2@etika.net.bo";
        // $oMail= new PHPMailer();
        // $oMail->isSMTP();
        // $oMail->Host="smtp.etika.net.bo";
        // $oMail->Port=25;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="seleccion2";
        // $oMail->Password="seleccion2021";
        // $oMail->setFrom($email_envio, "Cristian Salinas");
        // $oMail->addAddress("cchamby@dibeltecnologia.com","CChamby");
        // $oMail->Subject="cabecera prueba";
        // $oMail->msgHTML("Hola soy un mensaje");
         
        // if(!$oMail->send())
        //   echo $oMail->ErrorInfo;  
    }
    //prueba Amazon SES
    public function recuperar_contrasena_new($oMail, $emailDestino, $nombre_postulante, $asunto, $mensaje) {

        $oMail->isSMTP();

        $oMail->Host="email-smtp.us-east-2.amazonaws.com";
        
        $oMail->Port=587;
        $oMail->SMTPAuth=true;
     
        
             
        $oMail->Username='AKIASE2LHDBDPGQDW2EV';        
        $oMail->Password='BNeGd7X+2iIL9jIRDjgRSg845UQ2pqsqoQ/80A3XErAq';
           $oMail->SMTPSecure='tls';
        
        $oMail->CharSet = 'UTF-8';
        $oMail->setFrom("controlbole@etika.net.bo", "ETIKA");
        $oMail->addAddress($emailDestino, $nombre_postulante);
        // $oMail->addAddress('rsecko@dibeltecnologia.com', $nombre_postulante);
        $oMail->Subject=$asunto;
        $oMail->msgHTML($mensaje);
        $oMail->isHTML(true);
    

       if(!$oMail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $oMail->ErrorInfo;
            exit();
        }else{
            echo 'Message has been sent';
        }


        // $oMail= new PHPMailer();
        // $oMail->isSMTP();
        // $oMail->Host="smtp.gmail.com";
        // $oMail->Port=587;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="sjosefer07@gmail.com";
        // $oMail->Password="ewbcczrzqacomnku";
        // $oMail->CharSet = 'UTF-8';
        // $oMail->setFrom("sjosefer07@gmail.com", "Cristian Salinas");
        // $oMail->addAddress($emailDestino, $nombre_postulante);
        // $oMail->Subject=$asunto;
        // $oMail->msgHTML($mensaje);

        // if(!$oMail->send()){
        //     return $oMail->ErrorInfo; 
        // } else {
        //     return 1;
        // }

        // $email_envio = "seleccion2@etika.net.bo";
        // $oMail= new PHPMailer();
        // $oMail->isSMTP();
        // $oMail->Host="smtp.etika.net.bo";
        // $oMail->Port=25;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="seleccion2";
        // $oMail->Password="seleccion2021";
        // $oMail->setFrom($email_envio, "Cristian Salinas");
        // $oMail->addAddress("cchamby@dibeltecnologia.com","CChamby");
        // $oMail->Subject="cabecera prueba";
        // $oMail->msgHTML("Hola soy un mensaje");
         
        // if(!$oMail->send())
        //   echo $oMail->ErrorInfo;  

    }

    public function mensaje_contacto($oMail, $email, $nombre_postulante, $email_destino, $asunto, $mensaje) {

        // $oMail->isSMTP();
        // $oMail->Host="smtp.gmail.com";
        // $oMail->Port=587;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="sjosefer07@gmail.com";
        // $oMail->Password="ewbcczrzqacomnku";
        // $oMail->CharSet = 'UTF-8';
        // $oMail->setFrom($email, $nombre_postulante);
        // $oMail->addAddress("cchamby@dibeltecnologia.com","CChamby");
        // $oMail->Subject=$asunto;
        // $oMail->msgHTML($mensaje);

        $oMail->isSMTP();
        // $oMail->Host="etika.net.bo";
        $oMail->Host="smtp.gmail.com";

        // $oMail->Host="64.34.173.243";
        // $oMail->Port=25;
        $oMail->Port=587;
        $oMail->SMTPSecure='tls';
        $oMail->SMTPAuth=true;
        $oMail->SMTPAutoTLS = false;
        $oMail->SMTPKeepAlive = true;
        // $oMail->Username="seleccion2@etika.net.bo";
        // $oMail->Username="controlbole@etika.net.bo";
        $oMail->Username="sisetika@gmail.com";
        // $oMail->Password="seleccion2021";
        // $oMail->Password="dibel123";
        $oMail->Password="tvfxytqgqswhzomc";
        $oMail->CharSet = 'UTF-8';
        $oMail->setFrom($email, $nombre_postulante);
        $oMail->addAddress($email_destino);
        // $oMail->addAddress('cchamby@dibeltecnologia.com');
        $oMail->Subject=$asunto;
        $oMail->msgHTML($mensaje);
        $oMail->isHTML(true);
        $oMail->SMTPOptions = array(
                                    'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                    )
                                    );

        if(!$oMail->send()){
            return $oMail->ErrorInfo; 
        } else {
            return 1;
        }
    }

    public function formularioContacto($emailDestino, $email, $mensaje, $asunto) {
        $dominio = $_SERVER['HTTP_HOST'];
        $result = 0;
        $mail = $this->getMailer();
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $this->getHost();  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $this->getUsername();                 // SMTP username
        $mail->Password = $this->getPassword();                           // SMTP password
        $mail->SMTPSecure = $this->getSslTls('TLS');                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $this->getPort();                                    // TCP port to connect to
//        $mail->SMTPDebug = 1;
        $mail->setFrom($email);
        $mail->addAddress($emailDestino);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        // Activo condificacción utf-8
        $mail->CharSet = 'ISO-8859-1';
        $body = $mensaje;
        $mail->Subject = $asunto;
        $mail->Body = $body;
        if (!$mail->send()) {
//            $result = 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $result = 1;
        }
        return $result;
    }

//setters and getters
    function getMailer() {
        return $this->mailer;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getHost() {
        return $this->host;
    }

    function getPort() {
        return $this->port;
    }

    function getProtocol() {
        return $this->protocol;
    }

    function getSslTls() {
        return $this->sslTls;
    }

    function setMailer($mailer) {
        $this->mailer = $mailer;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setPort($port) {
        $this->port = $port;
    }

    function setProtocol($protocol) {
        $this->protocol = $protocol;
    }

    function setSslTls($sslTls) {
        $this->sslTls = $sslTls;
    }

}
