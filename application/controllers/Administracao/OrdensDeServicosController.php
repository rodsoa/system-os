<?php

use Entity\OrdemDeServico;
use Entity\Produto;
use Entity\Cliente;
use Entity\Usuario;
use Entity\Avaliacao;

class OrdensDeServicosController extends CI_Controller
{
    public function __construct() {
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

    public function index() {
        $ordens = $this->doctrine->em->getRepository(OrdemDeServico::class)->findAll();
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/ordens_de_servico/index',[
            'ordens' => $ordens
        ]);
    }

    public function adicionar() {
        $clientes = $this->doctrine->em->getRepository(Cliente::class)->findAll();
        $this->twig->display('app/ordens_de_servico/adicionar', ['clientes' => $clientes]);
    }

    public function cadastrar() {
        $os = new OrdemDeServico();
        $tecnico = $this->doctrine->em->getRepository(Usuario::class)->find( $this->session->usuario->getId() );
        $cliente = $this->doctrine->em->getRepository(Cliente::class)->find( $this->input->post('cliente') );
        
        foreach( $this->input->post() as $campo => $valor ) {
            if ( $campo === 'cliente' ) {
                $os->setCliente( $cliente );
                continue;
            }
        
            $setter = 'set' . ucfirst($campo);
            $os->$setter( $valor );
            $os->setTecnico( $tecnico );
        }
        
        // Status
        $os->setStatus('Aguardando Atendimento');

        // Atribuindo valor para data de adição
        $os->setCriadoEm( new \DateTime('now'));
        $os->setAtualizadoEm( new \DateTime('now'));

        $os->setDataInicial( new \DateTime('now') );
        
        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $os );
        $this->doctrine->em->flush();

        // Criando avaliação correspondente
        $avaliacao = new Avaliacao();
        $avaliacao->setOrdemDeServico( $os );
        $avaliacao->setCliente( $cliente );
        $avaliacao->setTecnico( $tecnico );

        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $avaliacao );
        $this->doctrine->em->flush();

        $dados['destinatario'] = ($os->getCliente())->getNome();
        $dados['email'] = ($os->getCliente())->getEmail();
        $dados['assunto'] = 'RESUMO DE ORDEM DE SERVICO - SYSTEM OS';
        $dados['mensagem'] = 'Segue em anexo resumo da ordem de serviço criada';
        if ( $this->enviarEmail( $os, $dados ) ) {
            $this->session->set_flashdata('msg_sucesso', 'Ordem de serviço cadastrada com sucesso');
            redirect('/ordens-de-servicos');
        } else {
            $this->session->set_flashdata('msg_sucesso', 'Ordem de serviço cadastrada com sucesso, mas ocorreu um erro no envio do email.');
            redirect('/ordens-de-servicos');
        }
    }

    public function editar( $id ) {
        $ordem = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );
        $clientes = $this->doctrine->em->getRepository(Cliente::class)->findAll();
        $tecnicos = $this->doctrine->em->getRepository(Usuario::class)->findAll();

        if ( $ordem ) {
            $this->twig->display('app/ordens_de_servico/editar', [
                'clientes' => $clientes,
                'tecnicos' => $tecnicos,
                'ordem'    => $ordem
            ]);
        } else {
            $this->session->set_flashdata('msg_erro', 'Ordem de serviço não encontrada');
            redirect('/ordens-de-servicos');
        }
    }

    public function atualizar( $id ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $id );
        
        foreach( $this->input->post() as $campo => $valor ) {
            if ( $campo === 'cliente' ) {
                $cliente = $this->doctrine->em->getRepository(Cliente::class)->find( $this->input->post('cliente') );
                $os->setCliente( $cliente );
                continue;
            } elseif ( $campo === 'tecnico') {
                $tecnico = $this->doctrine->em->getRepository(Usuario::class)->find( $this->input->post('tecnico') );
                $os->setTecnico( $tecnico );
                continue;
            } elseif ( ($campo === 'status') && ($valor === 'OS Finalizada') ) {
                $os->setDataFinal( new DateTime('now') );
            }
        
            $setter = 'set' . ucfirst($campo);
            $os->$setter( $valor );
        }

        // Atribuindo valor para data de adição
        $os->setAtualizadoEm( new \DateTime('now'));
        
        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $os );
        $this->doctrine->em->flush();


        // Enviando email de atualização
        $dados['destinatario'] = ($os->getCliente())->getNome();
        $dados['email'] = ($os->getCliente())->getEmail();
        $dados['assunto'] = 'RESUMO DE ORDEM DE SERVICO - SYSTEM OS';
        $dados['mensagem'] = 'Segue em anexo resumo da atualização que houve na ordem de serviço';
        if ( $this->enviarEmail( $os, $dados ) ) {
            $this->session->set_flashdata('msg_sucesso', 'Ordem de serviço editada com sucesso');
            redirect('/ordens-de-servicos');
        } else {
            $this->session->set_flashdata('msg_sucesso', 'Ordem de serviço editada com sucesso, mas ocorreu um erro no envio do email.');
            redirect('/ordens-de-servicos');
        }
    }

    public function deletar( $os ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $os );
        $this->doctrine->em->remove( $os );
        $this->doctrine->em->flush();

        redirect('/ordens-de-servicos');
    }


    private function enviarEmail( $os, $dados ) {
        $os = $this->doctrine->em->getRepository(OrdemDeServico::class)->find( $os );

        $destinatario = $dados['destinatario'];
        $email = $dados['email'];
        $assunto = $dados['assunto'];

        $mensagem = "<h3> InfoSys - Ordem de Serviço </h3>";
        $mensagem .= "<p> Estimado Sr(a).: <strong> $destinatario </strong></p>";
        // nl2br: converte new line (enter) para comandos <br>
        $mensagem .= nl2br($dados['mensagem']);

        $this->email->from('infobytemovel@gmail.com', 'InfoSys');
        $this->email->to($email);

        $this->email->subject($assunto);

        //$filename = base_url('mkt/fusca.jpg');
        //$this->email->attach($filename);
        //$cid = $this->email->attachment_cid($filename);
        $this->email->message($mensagem);

        $this->mpdf->WriteHtml( $this->twig->render('app/relatorios/pdf/os-detalhada', ['os' => $os]));
        $this->mpdf->Output(APPPATH.'../pdf/os/os-'. $os->getId() .'.pdf', 'F');
        // Adicionando arquivo anexo baseado na nomenclara e diretório que foi salvo
        $this->email->attach( APPPATH.'../pdf/os/os-'. $os->getId() .'.pdf' );

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }

    }
}