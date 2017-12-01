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
        } elseif ( $this->session->cliente ){
            redirect('/cliente-dashboard');
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

        if ( $this->input->post('tipo') === 'tecnico' ) {

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

        } elseif ( $this->input->post('tipo') === 'cliente' ) {

            $cliente = $this->doctrine->em->getRepository(Cliente::class)->findOneBy([
                'email' => $email,
                'senha' => $senha
            ]);

            if ( $cliente ) {
                $this->session->cliente = $cliente;
                redirect('/cliente-dashboard');
            } else {
                redirect('/login');
            }

        } else {
            redirect('/login');
        }




    }
}