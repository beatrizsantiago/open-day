<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class EventoController extends Action {
        public function indexEvento() {
            $listaEvento = Container::getModel('Evento');
            $this->view->eventos = $listaEvento->listarEventos();

            $this->render('indexEvento');
        }

        public function criarEvento() {
            $this->render('criarEvento');
        }

        public function cadastrarEvento() {

            $cadastrarEvento = Container::getModel('Evento');
            $cadastrarEvento->__set('nome', $_POST['nome']);
            $cadastrarEvento->__set('descricao', $_POST['descricao']);

            $cadastrarEvento->adicionarEvento();

            //print_r($cadastrarEvento);
            header('Location: /index_evento');
        }

        public function acaoEvento() {
            if(isset($_POST['ver_atividades'])) {
                $listaAtividade = Container::getModel('Atividade');
                $listaAtividade->__set('id', $_POST['ver_atividades']);
                $this->view->atividades = $listaAtividade->listarAtividades();
                
                $this->render('indexAtividade');
                //print_r($_POST['atividades']);
            }

            if(isset($_POST['criar_atividade'])) {
               $this->render('criarAtividade');
            }
        }
    }

?>