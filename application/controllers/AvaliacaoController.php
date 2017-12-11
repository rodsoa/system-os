<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Entity\Avaliacao;
use Entity\Cliente;
use Entity\OrdemDeServico;

class AvaliacaoController extends CI_Controller {

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
        $this->twig->addGlobal('session', $this->session);

    }

    public function index()
	{  
        $this->twig->display('app/pesquisa-os');
	}

    public function aprovar( $id ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );
        $os->setStatus('Orçamento Aprovado');
        $this->doctrine->em->persist( $os );
        $this->doctrine->em->flush();

        $this->session->set_flashdata('msg_sucesso', 'Serviço Aprovado!');        
        redirect('/pesquisar-os');
    }

    public function reprovar( $id ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );
        $os->setStatus('Orçamento Reprovado');
        $this->doctrine->em->persist( $os );
        $this->doctrine->em->flush();

        $this->session->set_flashdata('msg_erro', 'Serviço Reprovado!');        
        redirect('/pesquisar-os');
    }

	public function avaliar() {
        $id = $this->input->post('os');
        $senha = $this->input->post('senha');
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );

        $avaliacao = null;

        if ( $os ) {
            $avaliacao = $this->doctrine->em->getRepository(Avaliacao::class)->find( ($os->getAvaliacao())->getId() );
        }

        if ( $os && $avaliacao ) {
            if (  ($os->getCliente())->getSenha() == $senha ) {
                $this->twig->display('app/avaliar-servico', ['av' => $avaliacao]);
            } else {
                $this->session->set_flashdata('msg_erro', 'Senha de cliente incorreta');
                redirect('/pesquisar-os');
            }
        } else {
            $this->session->set_flashdata('msg_erro', 'Não existem registros para os dados passados');
            redirect('/pesquisar-os');
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

        $this->session->set_flashdata('msg_sucesso', 'Serviço Avaliado com sucesso.');
        redirect('/pesquisar-os');
    }
}
