<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Entity\Avaliacao;
use Entity\Cliente;

class ClienteDashboardController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        if ( !$this->session->cliente ) {
            redirect('/login');
        }

        $this->twig->addGlobal('session', $this->session);

    }

    public function index()
	{
	    $cliente = $this->doctrine->em->getRepository(Cliente::class)->find( $this->session->cliente->getId() );
        $avaliacoes = $this->doctrine->em->getRepository(Avaliacao::class)->findBy(['cliente' => $cliente, 'avaliacao' => 'SEM AVALIAÇÃO']);
		$this->twig->display('app/cliente-dashboard', [
            'avaliacoes' => $avaliacoes
        ]);
	}

	public function avaliar( $id ) {
        $avaliacao = $this->doctrine->em->getRepository(Avaliacao::class)->find( $id );
        if( $avaliacao->getAvaliacao() != 'SEM AVALIAÇÃO') {
            redirect('/cliente-dashboard');
        } else {
            $this->twig->display('app/avaliar-servico', ['av' => $avaliacao]);
        }
    }

    public function avaliarServico( $id ) {
        $av = $this->input->post('avaliacao');
        $comentario = $this->input->post('comentario');

        $avaliacao = $this->doctrine->em->getRepository(Avaliacao::class)->find( $id );
        $avaliacao->setAvaliacao( $av );
        $avaliacao->setComentario( $comentario );

        $this->doctrine->em->persist( $avaliacao );
        $this->doctrine->em->flush();

        redirect('/cliente-dashboard');
    }
}
