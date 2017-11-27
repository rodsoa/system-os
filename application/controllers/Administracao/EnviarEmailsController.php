<?php

use Entity\OrdemDeServico;

class EnviarEmailsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ( !$this->session->usuario ) {
            redirect('/login');
        }

        $this->twig->addGlobal('session', $this->session);

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'infobytemovel@gmail.com';
        $config['smtp_pass'] = '24802480';
        $config['charset'] = 'utf-8';
        // deve ser aspas duplas ""
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;

        $this->load->library('email');
        $this->mpdf = new \Mpdf\Mpdf();
        $this->email->initialize($config);



    }

    public function criarEmail( $os ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $os );
        $this->twig->display('app/ordens_de_servico/email', ['os' => $os]);
    }

    public function enviar( $os ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $os );

        $destinatario = $this->input->post('destinatario');
        $email = $this->input->post('email');
        $assunto = $this->input->post('assunto');

        $mensagem = "<h3> InfoSys - Ordem de Serviço </h3>";
        $mensagem .= "<p> Estimado Sr(a).: <strong> $destinatario </strong></p>";
        // nl2br: converte new line (enter) para comandos <br>
        $mensagem .= nl2br($this->input->post('mensagem'));

        $this->email->from('infobytemovel@gmail.com', 'InfoSys');
        $this->email->to($email);

        $this->email->subject($assunto);

        //$filename = base_url('mkt/fusca.jpg');
        //$this->email->attach($filename);
        //$cid = $this->email->attachment_cid($filename);
        $this->email->message($mensagem);

        if ( $this->input->post('os') ) {
            $this->mpdf->WriteHtml( $this->twig->render('app/relatorios/pdf/os-detalhada', ['os' => $os]));
            $this->mpdf->Output(APPPATH.'../pdf/os/os-'. $os->getId() .'.pdf', 'F');
            // Adicionando arquivo anexo baseado na nomenclara e diretório que foi salvo
            $this->email->attach( APPPATH.'../pdf/os/os-'. $os->getId() .'.pdf' );

        }

        if ($this->email->send()) {
            // atribui para variáveis de sessão "flash"
            $this->session->set_flashdata('msg_sucesso', 'E-mail Enviado com Sucesso');
            redirect('/ordens-de-servicos');
        } else {
            print_r($this->email->print_debugger());
        }

    }
}