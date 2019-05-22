<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class ParticipanteController extends Action {

        public function cadastroParticipante() {
            $this->view->participante = [
                'nome' => '',
                'email' => '',
                'telefone' => '',
                'escola' => '',
                'area' => ''
            ];
            $this->render('cadastroParticipante');
        }

        public function cadastrar() {

            $participante = Container::getModel('Participante');
            $participante->__set('nome', $_POST['nome']);
            $participante->__set('email', $_POST['email']);
            $participante->__set('telefone', $_POST['telefone']);
            $participante->__set('escola', $_POST['escola']);
            $participante->__set('area', $_POST['area']);

            //print_r($participante);
            
            //if(count($participante->getUsuarioLogin()) == 0) {
                
                $participante->criarParticipante();
                header('Location: /area_profissional');
                
            //} else {
                //$this->view->participante = [
                    //'nome' => $_POST['nome'],
                    //'instituicao' => $_POST['telefone'],
                    //'curso' => $_POST['area'],
                    //'login' => $_POST['login']
                //];
            //}
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