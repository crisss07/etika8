<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Authentication Class
 *
 * @package user controller
 * @subpackage user authentication
 * @author rodrigo secko
 * @copyright 19 abril, 2021
 * @since version 1.0.0
 * @sourcefile system/core/CI_Controller
 */
class Autenticar extends CI_Controller
{
    var $google_auth;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('Two_FactorAuth');
        $this->load->helper(array('url','form'));   
        $this->load->helper('html');
        $this->prefijo='eti_';
        $this->tabla='etiko';
        
        $this->no_mostrar_enlaces=1;
        //para la session
          
        //prefijo de variable session
         force_ssl();
        //$this->load->helper('url','form');
        $this->load->library('form_validation');        
        
       // $this->load->helper('html');
        //$this->definir_form();
        //**base de datos
        $this->campo=array('login','pass');
        //$this->load->database();        
        
        $this->carpeta='index/';
        //prefijo de variable session
        $this->presession=$this->tool_entidad->presession();
        session_start();
        //fin de la session

        $this->google_auth = new \Google\Authenticator\GoogleAuthenticator();
    }

     function index()
    {
        if (!isset($_SESSION[$this->presession.'usuario']))
        {            
            redirect('index/autenticar');
        }
        else
        {
            redirect('index/autenticar');
        }        
    }
    
    public function auth($id_usuario)
    {
        //codigo_secreto de la forma 'base64(id_usuario)'
        $id=base64_decode($id_usuario);
        $id_tabla=$this->prefijo.'id';
        $consulta = $this->db->query("SELECT google_auth_code,eti_email,eti_login FROM $this->tabla where $id_tabla=$id")->row();
        
       


        

        if (!isset($consulta->google_auth_code)) {//ingresa si no tiene registrado el codigo secreto
               $g_nombre=$consulta->eti_login;
               $g_sitio='etika.com.bo';
 
              $user_2fa_secret_code   = $this->google_auth->generateSecret();
              $data['contenido']='';

                $data = [
                    'page_title'            => 'Google Authenticator',
                 
                    'id'=>$id_usuario,                    
                    'user_2fa_secret_code'  => $user_2fa_secret_code,
                    'user_2fa_qrCode'       => $this->google_auth->getURL($g_nombre, $g_sitio, $user_2fa_secret_code),
                ];

       
        $this->load->view('auth/generaqr', $data);
        }else{//si ya tiene el codigo                 
            //$data['codigo'] = $consulta->google_auth_code;
            $data['id'] = $id_usuario;
            $data['sms'] = "Abra la aplicación Google Authenticator en su teléfono e ingrese el código de verificación generado.";
            $data['error'] = '';
            $this->load->view('auth/form_codigo.php',$data);

        }
      
    }

  

     public function codigo()
    {
            //guardar en la base de datos
        //UPDATE table_name

        $secret_code=$this->input->post('secret_code');
        $id=$this->input->post('id');
        $id=base64_decode($id);
        $id_tabla=$this->prefijo.'id';

        $consulta = $this->db->query("UPDATE $this->tabla SET google_auth_code='$secret_code' WHERE $id_tabla=$id");
       

            //$consulta = "UPDATE SET $this->tabla SET google_auth_code=$secret_code WHERE $id_tabla=$id";
            
            $data['codigo'] = trim($this->input->post('secret_code'));
            $data['id'] = trim($this->input->post('id'));
            $data['sms'] = "Abra la aplicación Google Authenticator en su teléfono e ingrese el código de verificación generado.";
            $data['error'] = '';
            $this->load->view('auth/form_codigo.php',$data);
       
    }
     public function verifica()
    {                 
            $code = $this->input->post('code');
            $id = $this->input->post('id');

            $id=base64_decode($id);
            $id_tabla=$this->prefijo.'id';
            $consulta = $this->db->query("SELECT google_auth_code FROM $this->tabla where $id_tabla=$id")->row();
            $secret_code=$consulta->google_auth_code;

            if ( $this->google_auth->checkCode($secret_code, $code) ) {
                // si todo salio correcto iniciar sesion
                $prefijo=$this->prefijo;
                    $fila = $this->db->query("SELECT * FROM $this->tabla where $id_tabla=$id")->row();
                    
                    $log_usuario=$prefijo.'login';
                    $log_id=$prefijo.'id';
                    $log_email=$prefijo.'email';
                    $log_permisos=$prefijo.'permisos';
                    
                    
                if (!isset($_SESSION[$this->presession . 'usuario'])) {//setear la session
                    $_SESSION[$this->presession . 'usuario'] = $fila->$log_usuario;
                    $_SESSION[$this->presession . 'id'] = $fila->$log_id;
                    $_SESSION[$this->presession . 'email'] = $fila->$log_email;
                    $_SESSION[$this->presession . 'permisos'] = $fila->$log_permisos;
                    
                }
               
                             
                redirect('inicio');
            } else {
                $data['id'] = trim($this->input->post('id'));
                $data['sms'] = "Abra la aplicación Google Authenticator en su teléfono e ingrese el código de verificación generado.";
                $data['error'] = "codigo invalido";
                $this->load->view('auth/form_codigo.php',$data);
            }
    }
}

