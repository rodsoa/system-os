<?php

/** Importando classe referente ao modelo de cliente */
use Entity\Cliente;

class ClientesController extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ( !$this->session->usuario ) {
            redirect('/login');
        }

        $this->twig->addGlobal('session', $this->session);

        /** TODO: VALIDACÃO DOS DADOS! */
    }

    /** GET /clientes */
    public function index() {
        $clientes = $this->doctrine->em->getRepository('Entity\Cliente')->findAll();
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/clientes/index', ['clientes' => $clientes]);
    }

    /** GET /clientes/adicionar */
    public function adicionar() {
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/clientes/adicionar');
    }

    /** POST /clientes */
    public function cadastrar() {

        /** Executando validações dos campos */
        if ( $this->form_validation->run('clientes') == FALSE ) {

            $this->session->set_flashdata('msg_erro', 'Campos não passaram pela validação');
            $this->session->set_flashdata('erros', $this->form_validation->error_array());
            redirect('/clientes/adicionar');

        } else {

            $cliente = new \Entity\Cliente();
            
            foreach( $this->input->post() as $campo => $valor ) {
                if ( $campo === 'tipo' ) continue;
    
                $setter = 'set' . ucfirst($campo);
                $cliente->$setter( $valor );
            }
            
            // Atribuindo valor para data de adição
            $cliente->setCriadoEm( new \DateTime('now'));

            if ( $this->validaCPF( $cliente->getDocumento() ) ) {
                // Persistindo e salvando dados no banco
                $this->doctrine->em->persist( $cliente );
                $this->doctrine->em->flush();
            
                $this->session->set_flashdata('msg_sucesso', 'Cliente cadastrado com sucesso');
                redirect('/clientes');
            } else {
                $this->session->set_flashdata('msg_erro', 'Documento inválido');
                redirect('/clientes/adicionar');
            }
        }
    }

    /** GET /clientes/(:num)/editar */
    public function editar($id) {
        $cliente = $this->doctrine->em->getRepository('Entity\Cliente')->find($id);

        if ($cliente) {
            $this->twig->display('app/clientes/editar', ['cliente' => $cliente]);
        } else {
            $this->session->set_flashdata('msg_erro', 'Cliente não cadastrado na base de dados');
            redirect('/clientes');
        }
    }

    /** POST|PUT /clientes/(:num) */
    public function atualizar($id) {
        $cliente = $this->doctrine->em->getRepository('Entity\Cliente')->find($id);

        foreach( $this->input->post() as $campo => $valor ) {
            if ( $campo === 'tipo' ) continue;
            if ( $campo === 'senha' && $valor === "" ) continue;

            $setter = 'set' . ucfirst($campo);
            $cliente->$setter( $valor );
        }

        // Persistindo e salvando dados no banco
        $this->doctrine->em->persist( $cliente );
        $this->doctrine->em->flush();

        $this->session->set_flashdata('msg_sucesso', 'Cliente editado com sucesso');
        redirect('/clientes');

    }

    /** DELETE /clientes/(:num) */
    public function deletar($id){
        $cliente = $this->doctrine->em->getRepository('Entity\Cliente')->find($id);

        if ( $cliente ) {
            $this->doctrine->em->remove( $cliente );
            $this->doctrine->em->flush();

            $this->session->set_flashdata('msg_sucesso', 'Cliente deletado com sucesso');
            redirect('/clientes');
        } else {
            $this->session->set_flashdata('msg_erro', 'Cliente inexistente na base de dados');
            redirect('/clientes');
        }
    }

    private function validaCPF($cpf){
        // determina um valor inicial para o digito $d1 e $d2
        // pra manter o respeito ;)
          $d1 = 0;
          $d2 = 0;
        // remove tudo que não seja número
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        // lista de cpf inválidos que serão ignorados
        $ignore_list = array(
          '00000000000',
          '01234567890',
          '11111111111',
          '22222222222',
          '33333333333',
          '44444444444',
          '55555555555',
          '66666666666',
          '77777777777',
          '88888888888',
          '99999999999'
        );
        // se o tamanho da string for dirente de 11 ou estiver
        // na lista de cpf ignorados já retorna false
        if(strlen($cpf) != 11 || in_array($cpf, $ignore_list)){
            return false;
        } else {
          // inicia o processo para achar o primeiro
          // número verificador usando os primeiros 9 dígitos
          for($i = 0; $i < 9; $i++){
            // inicialmente $d1 vale zero e é somando.
            // O loop passa por todos os 9 dígitos iniciais
            $d1 += $cpf[$i] * (10 - $i);
          }
          // acha o resto da divisão da soma acima por 11
          $r1 = $d1 % 11;
          // se $r1 maior que 1 retorna 11 menos $r1 se não
          // retona o valor zero para $d1
          $d1 = ($r1 > 1) ? (11 - $r1) : 0;
          // inicia o processo para achar o segundo
          // número verificador usando os primeiros 9 dígitos
          for($i = 0; $i < 9; $i++) {
            // inicialmente $d2 vale zero e é somando.
            // O loop passa por todos os 9 dígitos iniciais
            $d2 += $cpf[$i] * (11 - $i);
          }
          // $r2 será o resto da soma do cpf mais $d1 vezes 2
          // dividido por 11
          $r2 = ($d2 + ($d1 * 2)) % 11;
          // se $r2 mair que 1 retorna 11 menos $r2 se não
          // retorna o valor zeroa para $d2
          $d2 = ($r2 > 1) ? (11 - $r2) : 0;
          // retona true se os dois últimos dígitos do cpf
          // forem igual a concatenação de $d1 e $d2 e se não
          // deve retornar false.
          return (substr($cpf, -2) == $d1 . $d2) ? true : false;
        }
      }
}