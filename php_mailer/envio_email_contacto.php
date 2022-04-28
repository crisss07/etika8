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
class envio_email_contacto {

    private $mailer = "";
    private $username = "";
    private $password = "";
    private $host = "";
    private $port = "";
    private $protocol = "";
    private $sslTls = "";

    public function __construct($mailer) {
        $this->setMailer($mailer);
        $this->setHost("smtp.etika.net.bo");
        $this->setUsername("seleccion2@etika.net.bo");
        $this->setPassword("seleccion2021");
        $this->setPort(25);
        $this->setSslTls("tls");
        $this->setProtocol("http://");


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
        // $mail->isHTML(true);                                  // Set email format to HTML
        // Activo condificacción utf-8
        $mail->CharSet = 'UTF-8';

        $mail->Subject=$asunto;
        $mail->msgHTML($mensaje);
        // $body = $mensaje;
        // $mail->Subject = $asunto;
        // $mail->Body = $body;
        if (!$mail->send()) {
           $result = 'Mailer Error: ' . $mail->ErrorInfo;
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
