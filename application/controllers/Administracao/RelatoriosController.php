<?php

use Doctrine\ORM\Query\ResultSetMapping;

use Mpdf\Mpdf;
use Entity\OrdemDeServico;

class RelatoriosController extends CI_Controller
{
    private $mpdf;

    public function __construct()
    {
        parent::__construct();
        if ( !$this->session->usuario ) {
            redirect('/login');
        }
        $this->twig->addGlobal('session', $this->session);

        $this->mpdf = new Mpdf();
    }

    public function index() {
        $this->twig->display('app/relatorios/index');
    }

    public function gerarPDF() {
        $items       = $this->input->post('status');
        $dataInicial = $this->input->post('dataIncial') ? new \DateTime( $this->input->post('dataInicial')) : null;
        $dataFinal   = $this->input->post('dataFinal') ? new \DateTime( $this->input->post('dataFinal')) : null;;
        $os          = null;

        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->findBy(['status' => $items]);

        $this->mpdf->SetHeader('Relatórios de Ordens de Serviços');
        $this->mpdf->SetTitle('SYSTEM OS - Relatórios');
        $this->mpdf->setFooter('{PAGENO}');
        $this->mpdf->writeHTML( $this->twig->render('app/relatorios/pdf/relatorio-os', ['ordens' => $os]) );
        $this->mpdf->Output();
    }

    public function gerarPdfOs($id) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find($id);
        $this->mpdf->SetHeader('Relatórios de Ordens de Serviços');
        $this->mpdf->SetTitle('SYSTEM OS - Relatórios');
        $this->mpdf->setFooter('{PAGENO}');
        $this->mpdf->writeHTML( $this->twig->render('app/relatorios/pdf/os-detalhada', ['os' => $os]) );
        $this->mpdf->Output();
    }
}