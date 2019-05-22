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
                $id = $_POST['ver_atividades'];
                header('Location: /index_atividade?id=' . $id);
                //print_r($_POST['atividades']);
            }

            if(isset($_POST['criar_atividade'])) {
               $this->render('criarAtividade');
            }

            if(isset($_POST['deletar'])) {
                $deletarEvento = Container::getModel('Evento');
                $deletarEvento->__set('id', $_POST['deletar']);

                $deletarEvento->deletarEvento();

                //print_r($deletarEvento);
                header('Location: /index_evento');
            }
        }
    }

?>