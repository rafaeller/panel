<?php

return [
    'sign_in' => 'Entrar',
    'go_to_login' => 'Fazer Login',
    'failed' => 'Informações de Login não encontradas.',

    'forgot_password' => [
        'label' => 'Esqueceu sua senha?',
        'label_help' => 'Escreva o email da sua conta para receber instruções para redefinir sua senha.',
        'button' => 'Recuperar Conta',
    ],

    'reset_password' => [
        'button' => 'Redefinir e Cadastrar',
    ],

    'two_factor' => [
        'label' => 'Token de Autenticação de dois fatores',
        'label_help' => 'Esta conta requer uma segunda camada de autenticação para continuar. Digite o código gerado pelo seu dispositivo para concluir este login.',
        'checkpoint_failed' => 'O token de autenticação de dois fatores é inválido.',
    ],

    'throttle' => 'Muitas tentativas de login. Por favor tente novamente em :seconds seconds.',
    'password_requirements' => 'A senha deve ter pelo menos 8 caracteres e deve ser exclusiva para este site.',
    '2fa_must_be_enabled' => 'O administrador solicitou que a autenticação de dois fatores seja ativada para sua conta para usar o painel.',
];
