<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

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
        if ( !$this->session->usuario ) {
            redirect('/login');
        }

        $this->twig->addGlobal('session', $this->session);

    }

    public function index()
	{
	    $clientes   = count( $this->doctrine->em->getRepository('Entity\Cliente')->findAll());
	    $os         = count( $this->doctrine->em->getRepository('Entity\OrdemDeServico')->findAll());
	    $ordens     = $this->doctrine->em->getRepository('Entity\OrdemDeServico')->findBy(['status' => 'Aguardando Atendimento']);
	    $avaliacoes = $this->doctrine->em->getRepository('Entity\Avaliacao')->findAll();
	    $usuarios   = count( $this->doctrine->em->getRepository('Entity\Usuario')->findAll());
        $produtos   = count( $this->doctrine->em->getRepository('Entity\Usuario')->findAll());

        $aguardandoAtendimento = count($this->doctrine->em->getRepository('Entity\OrdemDeServico')->findBy(['status' => 'Aguardando Atendimento']));
        $orcamentoAprovado     = count($this->doctrine->em->getRepository('Entity\OrdemDeServico')->findBy(['status' => 'Orçamento Aprovado']));
        $orcamentoReprovado    = count($this->doctrine->em->getRepository('Entity\OrdemDeServico')->findBy(['status' => 'Orçamento Reprovado']));
		$equipamentoEmAnalise  = count($this->doctrine->em->getRepository('Entity\OrdemDeServico')->findBy(['status' => 'Equipamento em Análise']));
		$aguardandoRetirada    = count($this->doctrine->em->getRepository('Entity\OrdemDeServico')->findBy(['status' => 'Aguardando Retirada']));
		$osFinalizada          = count($this->doctrine->em->getRepository('Entity\OrdemDeServico')->findBy(['status' => 'OS Finalizada']));


		$this->twig->display('app/dashboard', [
		    "clientes" => $clientes,
            "os" => $os,
            "avaliacoes" => $avaliacoes,
            "ordens" => $ordens,
            "usuarios" => $usuarios,
            "produtos" => $produtos,

            "agdAtendimento" =>$aguardandoAtendimento,
            "ocmtAprovado"   => $orcamentoAprovado,
            "ocmtReprovado"  => $orcamentoReprovado,
			"eqpmtAnalise"   => $equipamentoEmAnalise,
			"agdRetirada"    => $aguardandoRetirada,
			"osFinalizada"   => $osFinalizada
        ]);
	}
}
