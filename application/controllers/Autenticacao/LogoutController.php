<?php

class LogoutController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function logout() {
        if ( $this->session->usuario ) {
            unset($_SESSION['usuario']);
        }

        if ( $this->session->cliente ) {
            unset($_SESSION['cliente']);
        }

        redirect('/');
    }
}