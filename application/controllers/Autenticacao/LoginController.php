<?php
use Entity\Usuario;
use Entity\Cliente;

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->twig->addGlobal('session', $this->session);
        if ( $this->session->usuario ) {
            redirect('/');
        }
    }

    public function login() {
        $this->twig->display('app/autenticacao/login');
    }

    public function loginUsuario() {

        //header('content-type: application/json');
        //echo json_encode( $this->input->post() );

        $email = $this->input->post('email');
        $senha = md5($this->input->post('senha'));

        $recaptchaResponse = $this->input->post('g-recaptcha-response');
        $secret = '6LdDhjwUAAAAABAbnRp9TmGdr0_oAuezBH530f0X';
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data1 = array('secret' => $secret, 'response' => $recaptchaResponse);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);

        curl_close($ch);

        $status = json_decode($response, true);

        if ( $status['success'] ) {

            $usuario = $this->doctrine->em->getRepository(Usuario::class)->findOneBy([
                'email' => $email,
                'senha' => $senha
            ]);

            if ( $usuario ) {
                $this->session->usuario = $usuario;
                redirect('/');
            } else {
                $this->session->set_flashdata('msg_erro', 'Não foi possível realizar login com as credenciais passadas');
                redirect('/login');
            }
        } else {
            $this->session->set_flashdata('msg_erro', 'Recaptcha necessário');
            redirect('/login');
        }
    
    }
}