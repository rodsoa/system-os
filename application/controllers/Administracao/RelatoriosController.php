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
        $dataInicial = $this->input->post('dataIncial');
        $dataFinal   = $this->input->post('dataFinal');
        $os          = null;

        if ( $dataInicial && !$dataFinal ) {
            $rsm = new ResultSetMapping();
            $query ="SELECT * FROM ordens_de_servicos WHERE ";

            foreach ($items as $status ){
                if ( !next($items) ) {
                    $query .= "status = '$status' ";
                } else {
                    $query .= "status = '$status' OR ";
                }
            }

            $query .= "AND data_incial >= $dataInicial";

            $os = $this->doctrine->em
                ->createNativeQuery($query, $rsm)
                ->getResult();
        }elseif ( $dataFinal && !$dataInicial ) {
            $rsm = new ResultSetMapping();
            $query ="SELECT * FROM ordens_de_servicos WHERE ";

            foreach ($items as $status ){
                if ( !next($items) ) {
                    $query .= "status = '$status' ";
                } else {
                    $query .= "status = '$status' OR ";
                }
            }

            $query .= "AND data_final <= $dataFinal";

            $os = $this->doctrine->em
                          ->createNativeQuery($query, $rsm)
                          ->getResult();
        }elseif ( $dataFinal && $dataInicial ) {
            $rsm = new ResultSetMapping();
            $query ="SELECT * FROM ordens_de_servicos WHERE ";

            foreach ($items as $status ){
                if ( !next($items) ) {
                    $query .= "status = '$status' ";
                } else {
                    $query .= "status = '$status' OR ";
                }
            }

            $query .= "AND BETWEEN $dataInicial AND $dataFinal";

            $os = $this->doctrine->em
                ->createNativeQuery($query, $rsm)
                ->getResult();
        } else {
            $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->findBy(['status' => $items]);
        }

        $this->mpdf->writeHTML( $this->twig->render('app/relatorios/pdf/relatorio-os', ['ordens' => $os]) );
        $this->mpdf->Output();
    }
}