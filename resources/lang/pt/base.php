<?php

return [
    'validation_error' => 'Ocorreu um erro com um ou mais campos na solicitação.',
    'errors' => [
        'return' => 'Voltar à página anterior',
        'home' => 'Ir a página principal',
        '403' => [
            'header' => 'Forbidden',
            'desc' => 'Você não tem permissão para acessar este recurso neste servidor.',
        ],
        '404' => [
            'header' => 'Arquivo não encontrado.',
            'desc' => 'Não foi possível localizar o recurso solicitado no servidor.',
        ],
        'installing' => [
            'header' => 'Instalando Servidor',
            'desc' => 'O servidor solicitado ainda está concluindo o processo de instalação. Verifique novamente em alguns minutos. Você receberá um e-mail assim que esse processo for concluído.',
        ],
        'suspended' => [
            'header' => 'Servidor Suspenso',
            'desc' => 'Este servidor foi suspenso e não pode ser acessado.',
        ],
        'maintenance' => [
            'header' => 'Nódulo em Manutenção',
            'title' => 'Temporariamente indisponível',
            'desc' => 'Este nódulo está em manutenção, portanto, seu servidor não pode ser acessado temporariamente.',
        ],
    ],
    'index' => [
        'header' => 'Seus Servidores',
        'header_sub' => 'Servidores aos quais você tem acesso.',
        'list' => 'Lista de Servidores',
    ],
    'api' => [
        'index' => [
            'list' => 'Suas Chaves',
            'header' => 'API da Conta',
            'header_sub' => 'Gerencie chaves de acesso que permitem executar ações no painel.',
            'create_new' => 'Criar nova chave de API',
            'keypair_created' => 'Uma chave de API foi gerada com sucesso e está listada abaixo.',
        ],
        'new' => [
            'header' => 'Nova chave de API',
            'header_sub' => 'Crie uma nova chave de acesso à conta.',
            'form_title' => 'Detalhes',
            'descriptive_memo' => [
                'title' => 'Descrição',
                'description' => 'Digite uma breve descrição dessa chave que será útil para referência.',
            ],
            'allowed_ips' => [
                'title' => 'IPs permitidos',
                'description' => 'Digite uma lista delimitada por linha de IPs com permissão para acessar a API usando essa chave. A notação CIDR é permitida. Deixe em branco para permitir qualquer IP.',
            ],
        ],
    ],
];
