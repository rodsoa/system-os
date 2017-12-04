<?php
use Entity\Usuario;
use Entity\Cliente;

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

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

        $usuario = $this->doctrine->em->getRepository(Usuario::class)->findOneBy([
            'email' => $email,
            'senha' => $senha
        ]);

        if ( $usuario ) {
            $this->session->usuario = $usuario;
            redirect('/');
        } else {
            redirect('/login');
        }
    
    }
}