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
            $cadastrarEvento->__set('titulo', $_POST['titulo']);
            $cadastrarEvento->__set('descricao', $_POST['descricao']);

            $cadastrarEvento->adicionarEvento();

            header('Location: /index_evento');
        }

        /*public function acaoEvento() {

            if(isset($_POST['cancelar'])) {
                $cancelar = Container::getModel('Evento');
                $cancelar->__set('id', $_POST['cancelar']);

                $cancelar->deletarEvento();
                header('Location: /index_evento');
            }
            if(isset($_POST['alterar'])) {
                print_r($_POST['alterar']);
            }
            if(isset($_POST['atividades'])) {
                
                //print_r($_POST['atividades']);
                header('Location: /index_atividade');
            }
                       
        }*/

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