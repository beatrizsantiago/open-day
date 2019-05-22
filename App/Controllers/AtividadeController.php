<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AtividadeController extends Action {

        public function indexAtividade() {
            $listaAtividade = Container::getModel('Atividade');   
            $listaAtividade->__set('id', $_GET['id']);
            $this->view->atividades = $listaAtividade->listarAtividades();
            $this->render('indexAtividade');
        }

        public function cadastrarAtividade() {
            $atividade = Container::getModel('Atividade');
            $atividade->__set('eventoId', $_POST['id']);
            $atividade->__set('tema', $_POST['tema']);
            $atividade->__set('hora', $_POST['hora']);
            $atividade->__set('local', $_POST['local']);
            $atividade->__set('descricao', $_POST['descricao']);

            $atividade->adicionarAtividade();

            header('location: /index_evento');
        }

        //public function acaoAtividade() {
            //if(isset($_POST['deletar'])) {
                //$deletarAtividade = Container::getModel('Atividade');
                //$deletarAtividade->__set('id', $_POST['deletar']);

                //$deletarAtividade->deletarAtividade();

                //print_r($_POST['deletar']);
                //header('Location: /index_atividade?id=' . $_POST['deletar']);
            //}
        //}

    }

?>