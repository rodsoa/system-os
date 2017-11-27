<?php

use Entity\OrdemDeServico;
use Entity\Produto;
use Entity\Cliente;
use Entity\Usuario;

class OrdensDeServicosController extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        if ( !$this->session->usuario ) {
            redirect('/login');
        }
        $this->twig->addGlobal('session', $this->session);

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
        
        foreach( $this->input->post() as $campo => $valor ) {
            if ( $campo === 'cliente' ) {
                $cliente = $this->doctrine->em->getRepository(Cliente::class)->find( $this->input->post('cliente') );
                $os->setCliente( $cliente );
                continue;
            }
        
            $setter = 'set' . ucfirst($campo);
            $os->$setter( $valor );
            $os->setTecnico( $tecnico );
        }
        
        // Status
        $os->setStatus('Orçamento');

        // Atribuindo valor para data de adição
        $os->setCriadoEm( new \DateTime('now'));
        $os->setAtualizadoEm( new \DateTime('now'));
        
        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $os );
        $this->doctrine->em->flush();
        
        $this->session->set_flashdata('msg_sucesso', 'Ordem de serviço cadastrada com sucesso');
        redirect('/ordens-de-servicos');
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
            } elseif ( ( $campo === 'dataInicial') || ( $campo === 'dataFinal') ) {
                $setter = 'set' . ucfirst($campo);
                $os->$setter( \DateTime::createFromFormat('Y-m-d', $valor) );
                continue;
            }
        
            $setter = 'set' . ucfirst($campo);
            $os->$setter( $valor );
        }

        // Atribuindo valor para data de adição
        $os->setAtualizadoEm( new \DateTime('now'));
        
        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $os );
        $this->doctrine->em->flush();
        
        $this->session->set_flashdata('msg_sucesso', 'Ordem de serviço editada com sucesso');
        redirect('/ordens-de-servicos');
    }
}