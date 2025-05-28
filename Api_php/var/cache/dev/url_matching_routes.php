<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/v1' => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui', 'require_auth' => false], null, ['GET' => 0], null, false, false, null]],
        '/api/v1/doc.json' => [[['_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controller.swagger', 'require_auth' => false], null, ['GET' => 0], null, false, false, null]],
        '/api/auth/registrar-usuario' => [[['_route' => 'app_auth_register', '_controller' => 'App\\Controller\\AuthController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api/auth/login' => [[['_route' => 'app_auth_login', '_controller' => 'App\\Controller\\AuthController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/dados-banco' => [[['_route' => 'app_dadosbanco_cadastrar', '_controller' => 'App\\Controller\\DadosBancoController::cadastrar'], null, ['POST' => 0], null, false, false, null]],
        '/api/giftcard-produtos/giftcards' => [[['_route' => 'app_giftcardproduto_listartodos', '_controller' => 'App\\Controller\\GiftcardProdutoController::listarTodos'], null, ['GET' => 0], null, false, false, null]],
        '/api/giftcard-produtos/criar-giftcard' => [[['_route' => 'app_giftcardproduto_criar', '_controller' => 'App\\Controller\\GiftcardProdutoController::criar'], null, ['POST' => 0], null, false, false, null]],
        '/api/giftcard-seriais' => [[['_route' => 'app_giftcardserial_listartodos', '_controller' => 'App\\Controller\\GiftcardSerialController::listarTodos'], null, ['GET' => 0], null, false, false, null]],
        '/api/giftcard-valores' => [
            [['_route' => 'app_giftcardvalue_listarporprodutoid', '_controller' => 'App\\Controller\\GiftcardValueController::listarPorProdutoId'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_giftcardvalue_criar', '_controller' => 'App\\Controller\\GiftcardValueController::criar'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/pagamentos' => [[['_route' => 'app_pagamento_criar', '_controller' => 'App\\Controller\\PagamentoController::criar'], null, ['POST' => 0], null, false, false, null]],
        '/api/usuario/listar' => [[['_route' => 'visualizar_usuario', '_controller' => 'App\\Controller\\UsuarioController::viewUser'], null, ['GET' => 0], null, false, false, null]],
        '/api/usuario/listar-todos' => [[['_route' => 'visualizar_todos_usuario', '_controller' => 'App\\Controller\\UsuarioController::viewUserAll'], null, ['GET' => 0], null, false, false, null]],
        '/api/vendas' => [
            [['_route' => 'app_venda_listartodas', '_controller' => 'App\\Controller\\VendaController::listarTodas'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_venda_comprar', '_controller' => 'App\\Controller\\VendaController::comprar'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api(?'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:37)'
                        .'|\\.well\\-known/genid/([^/]++)(*:72)'
                        .'|validation_errors/([^/]++)(*:105)'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:142)'
                    .'|/(?'
                        .'|contexts/([^.]+)(?:\\.(jsonld))?(*:185)'
                        .'|errors/(\\d+)(?:\\.([^/]++))?(*:220)'
                        .'|v(?'
                            .'|alidation_errors/([^/]++)(?'
                                .'|(*:260)'
                            .')'
                            .'|endas/(?'
                                .'|usuario/([^/]++)(*:294)'
                                .'|([^/]++)(*:310)'
                            .')'
                        .')'
                        .'|dados\\-banco/([^/]++)(*:341)'
                        .'|giftcard\\-produtos/giftcard/([^/]++)(*:385)'
                        .'|pagamentos/([^/]++)(*:412)'
                        .'|usuario/remover/([^/]++)(*:444)'
                    .')'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:482)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        37 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        72 => [[['_route' => 'api_genid', '_controller' => 'api_platform.action.not_exposed', '_api_respond' => 'true'], ['id'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        105 => [[['_route' => 'api_validation_errors', '_controller' => 'api_platform.action.not_exposed'], ['id'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        142 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        185 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], ['GET' => 0, 'HEAD' => 1], null, false, true, null]],
        220 => [[['_route' => '_api_errors', '_controller' => 'api_platform.symfony.main_controller', '_stateless' => null, '_api_resource_class' => 'ApiPlatform\\State\\ApiResource\\Error', '_api_operation_name' => '_api_errors', '_format' => null], ['status', '_format'], ['GET' => 0], null, false, true, null]],
        260 => [
            [['_route' => '_api_validation_errors_problem', '_controller' => 'api_platform.symfony.main_controller', '_stateless' => null, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_problem', '_format' => null], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_hydra', '_controller' => 'api_platform.symfony.main_controller', '_stateless' => null, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_hydra', '_format' => null], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_jsonapi', '_controller' => 'api_platform.symfony.main_controller', '_stateless' => null, '_api_resource_class' => 'ApiPlatform\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_jsonapi', '_format' => null], ['id'], ['GET' => 0], null, false, true, null],
        ],
        294 => [[['_route' => 'app_venda_listarporusuario', '_controller' => 'App\\Controller\\VendaController::listarPorUsuario'], ['usuarioId'], ['GET' => 0], null, false, true, null]],
        310 => [[['_route' => 'app_venda_deletar', '_controller' => 'App\\Controller\\VendaController::deletar'], ['id'], ['DELETE' => 0], null, false, true, null]],
        341 => [[['_route' => 'app_dadosbanco_buscarporusuario', '_controller' => 'App\\Controller\\DadosBancoController::buscarPorUsuario'], ['usuarioId'], ['GET' => 0], null, false, true, null]],
        385 => [[['_route' => 'app_giftcardproduto_buscarporid', '_controller' => 'App\\Controller\\GiftcardProdutoController::buscarPorId'], ['id'], ['GET' => 0], null, false, true, null]],
        412 => [[['_route' => 'app_pagamento_buscarporid', '_controller' => 'App\\Controller\\PagamentoController::buscarPorId'], ['id'], ['GET' => 0], null, false, true, null]],
        444 => [[['_route' => 'remover_usuario', '_controller' => 'App\\Controller\\UsuarioController::remover'], ['id'], ['DELETE' => 0], null, false, true, null]],
        482 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
