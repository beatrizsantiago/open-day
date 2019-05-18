<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AtividadeController extends Action {

        public function cadastrarAtividade() {
            $atividade = Container::getModel('Atividade');
            $atividade->__set('eventoId', $_POST['id']);
            $atividade->__set('tema', $_POST['tema']);
            $atividade->__set('tipo', $_POST['tipo']);
            $atividade->__set('hora', $_POST['hora']);
            $atividade->__set('local', $_POST['local']);
            $atividade->__set('descricao', $_POST['descricao']);

            $atividade->adicionarAtividade();

            header('location: /index_evento');
        }

    }

?>