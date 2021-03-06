<?php

    namespace App;

    use MF\Init\Bootstrap;

    class Route extends Bootstrap {
        
        protected function initRoutes() {
            $routes['index'] = [
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            ];

            $routes['cadastroParticipante'] = [
                'route' => '/cadastro_participante',
                'controller' => 'ParticipanteController',
                'action' => 'cadastroParticipante'
            ];

            $routes['listarParticipante'] = [
                'route' => '/listar_participante',
                'controller' => 'ParticipanteController',
                'action' => 'listarParticipante'
            ];

            $routes['cadastrar'] = [
                'route' => '/cadastrar',
                'controller' => 'ParticipanteController',
                'action' => 'cadastrar'
            ];

            $routes['autenticar'] = [
                'route' => '/autenticar',
                'controller' => 'AuthController',
                'action' => 'autenticar'
            ];

            $routes['sair'] = [
                'route' => '/sair',
                'controller' => 'AuthController',
                'action' => 'sair'
            ];

            $routes['indexEvento'] = [
                'route' => '/index_evento',
                'controller' => 'EventoController',
                'action' => 'indexEvento'
            ];

            $routes['criarEvento'] = [
                'route' => '/criar_evento',
                'controller' => 'EventoController',
                'action' => 'criarEvento'
            ];

            $routes['cadastrarEvento'] = [
                'route' => '/cadastrar_evento',
                'controller' => 'EventoController',
                'action' => 'cadastrarEvento'
            ];

            $routes['acaoEvento'] = [
                'route' => '/acao_evento',
                'controller' => 'EventoController',
                'action' => 'acaoEvento'
            ];
            
            $routes['indexAtividade'] = [
                'route' => '/index_atividade',
                'controller' => 'AtividadeController',
                'action' => 'indexAtividade'
            ];
            
            $routes['atividadesEvento'] = [
                'route' => '/atividades_evento',
                'controller' => 'AtividadeController',
                'action' => 'atividadesEvento'
            ];
            
            $routes['criarAtividade'] = [
                'route' => '/criar_atividade',
                'controller' => 'AtividadeController',
                'action' => 'criarAtividade'
            ];
            
            $routes['cadastrarAtividade'] = [
                'route' => '/cadastrar_atividade',
                'controller' => 'AtividadeController',
                'action' => 'cadastrarAtividade'
            ];

            $routes['acaoAtividade'] = [
                'route' => '/acao_atividade',
                'controller' => 'AtividadeController',
                'action' => 'acaoAtividade'
            ];
            
            $routes['areaProfissional'] = [
                'route' => '/area_profissional',
                'controller' => 'ParticipanteController',
                'action' => 'listarAreas'
            ];

            $routes['listaAtividades'] = [
                'route' => '/lista_atividade',
                'controller' => 'ParticipanteController',
                'action' => 'listaAtividade'
            ];

            $this->setRoutes($routes);
        }

    }

?>