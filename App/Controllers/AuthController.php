<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action {
        public function autenticar() {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('login', $_POST['login']);
            $usuario->__set('senha', $_POST['senha']);

            $retorno = $usuario->autenticar();

            if($usuario->__get('id') != '' && $usuario->__get('login')) {
                session_start();
                $_SESSION['id'] = $usuario->__get('id');
                $_SESSION['login'] = $usuario->__get('login');

                header('Location: /index_evento');
            } else {
                header('location: /?login=erro');
            }
        }

        public function sair() {
            session_start();
            session_destroy();
            header('Location: /');
        }
    }

?>