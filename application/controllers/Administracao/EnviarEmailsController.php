<?php


class EnviarEmailsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ( !$this->session->usuario ) {
            redirect('/login');
        }
        $this->twig->addGlobal('session', $this->session);
    }

    public function criarEmail() {

    }

    public function enviar() {

    }
}