<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class ParticipanteController extends Action {

        public function cadastroParticipante() {
            $this->view->participante = [
                'nome' => '',
                'instituicao' => '',
                'curso' => '',
                'login' => '',
                'senha' => ''
            ];
            $this->view->erroCadastro = false;
            $this->render('cadastroParticipante');
        }

        public function cadastrar() {

            $participante = Container::getModel('Participante');
            $participante->__set('nome', $_POST['nome']);
            $participante->__set('apelido', explode(" ", $_POST['nome'])[0]);
            $participante->__set('instituicao', $_POST['telefone']);
            $participante->__set('curso', $_POST['area']);
            $participante->__set('login', $_POST['login']);

            if(count($participante->getUsuarioLogin()) == 0) {
                $participante->criarParticipante();

                header('Location: /area_profissional');
                
            } else {
                $this->view->participante = [
                    'nome' => $_POST['nome'],
                    'instituicao' => $_POST['telefone'],
                    'curso' => $_POST['area'],
                    'login' => $_POST['login']
                ];
                $this->view->erroCadastro = true;
            }
        }

        public function listarAreas() {
            $listaEvento = Container::getModel('Evento');
            $this->view->eventos = $listaEvento->listarEventos();

            $this->render('indexParticipante');
        }

        public function listaAtividade() {
            $listaAtividade = Container::getModel('Atividade');
            $listaAtividade->__set('id', $_GET['id']);
            $this->view->atividades = $listaAtividade->listarAtividades();
            
            $this->render('listaAtividades');

            //print_r($_GET['id']);
        }
    }

?>