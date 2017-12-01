<?php
/** Importando classe referente ao modelo de usuário */
use Entity\Usuario;

class UsuariosController extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ( !$this->session->usuario ) {
            redirect('/login');
        }

        $this->twig->addGlobal('session', $this->session);
    }

    /**
     * Rota: GET /usuarios
     */
    public function index() {
        $usuarios = $this->doctrine->em->getRepository('Entity\Usuario')->findAll();
        $dados['usuarios'] = $usuarios;
        // Deixando 'session' global para acesso via template
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/usuarios/index', $dados);
    }

    /**
     * Rota: GET /usuarios/(:num)
     */
    public function exibir($id)
    {}

    /**
     * Rota: GET /usuarios/adicionar
     */
    public function adicionar() {
        $this->twig->addGlobal('session', $this->session);
        $this->twig->display('app/usuarios/adicionar');
    }

    /**
     * Rota: POST /usuarios
     */
    public function cadastrar() {

        if ($this->form_validation->run('usuarios') == FALSE){

            $this->session->set_flashdata('msg_erro', 'Campos não passaram pela validação');
            $this->session->set_flashdata('erros', $this->form_validation->error_array());

            redirect('/usuarios/adicionar');
        } else {

            /** Atribuindo valores obtidos pelo formulários */
            $cpf            = $this->input->post('cpf');
            $nome           = $this->input->post('nome');
            $email          = $this->input->post('email');
            $senha          = $this->input->post('senha');
            $confirme_senha = $this->input->post('confirme_senha');
            $criado_em      = new \DateTime('now');
            $status         = true;

            /** Instanciando modelo de usuário e setando valores */
            $usuario = new Usuario();
            $usuario->setCpf( $cpf );
            $usuario->setNome( $nome );
            $usuario->setEmail( $email);
            $usuario->setSenha( $senha );
            $usuario->setCriadoEm( $criado_em );
            $usuario->setStatus( $status);

            /** Persistindo novo usuário no banco de dados */
            $this->doctrine->em->persist( $usuario );
            $this->doctrine->em->flush();

            /** setando mensagem de feedback e realizando redirecionamento */
            $this->session->set_flashdata('msg_sucesso', 'Usuário cadastrado com sucesso!');
            redirect('/usuarios');
        }
    }

    /**
     * Rota: GET /usuarios/(:num)/editar
     */
    public function editar($id) {
        $usuario = $this->doctrine->em->getRepository('Entity\Usuario')->find($id);

        if ( $usuario ){
            $this->twig->addGlobal('session', $this->session);
            $this->twig->display('app/usuarios/editar', ['usuario' => $usuario]);
        } else {
            $this->session->set_flashdata('msg_erro', 'Usuário não cadastrado na base de dados');
            redirect('/usuarios');
        }
    }

    /**
     * Rota: PUT|POST /usuarios/(:num)
     */
    public function atualizar($id){
        /** Atribuindo valores obtidos pelo formulários */
        $cpf            = $this->input->post('cpf');
        $nome           = $this->input->post('nome');
        $email          = $this->input->post('email');
        $senha          = $this->input->post('senha');
        $confirme_senha = $this->input->post('confirme_senha');

        /** Instanciando modelo de usuário e setando valores */
        $usuario = $this->doctrine->em->getRepository('Entity\Usuario')->find($id);

        if ( $senha && $confirme_senha ) {
            if ( $senha === $confirme_senha ) {
                $usuario->setSenha( $senha );
            } else {
              $this->session->set_flashdata('msg_erro', 'Senhas não conferem. Tente novamente');
              redirect("/usuarios/$id/editar");
            }
        }

        $usuario->setCpf( $cpf );
        $usuario->setNome( $nome );
        $usuario->setEmail( $email);

        /** Persistindo novo usuário no banco de dados */
        $this->doctrine->em->persist( $usuario );
        $this->doctrine->em->flush();

        $this->session->set_flashdata('msg_sucesso', 'Usuário editado com sucesso');
        redirect('/usuarios');
    }

    /**
     * Rota: DELETE /usuarios/(:num)
     * Esse método é acessado via 'ajax'. Então não há valor de retorno
     */
    public function deletar($id) {
        $usuario = $this->doctrine->em->getRepository('Entity\Usuario')->find($id);

        if ( $usuario ) {
            /** Removendo e comitando mudanças no banco de dados */
            $this->doctrine->em->remove($usuario);
            $this->doctrine->em->flush();

            $this->session->set_flashdata('msg_sucesso', 'Cliente deletado com sucesso');
            redirect('/');
        } else {
            $this->session->set_flashdata('msg_erro', 'Cliente inexistente na base de dados');
            redirect('/clientes');
        }
    }
}