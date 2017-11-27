<?php

class Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ( !$this->session->usuario ) {
            redirect('/login');
        }

        $this->twig->addGlobal('session', $this->session);
    }
}