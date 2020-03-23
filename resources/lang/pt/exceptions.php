<?php

return [
    'daemon_connection_failed' => 'Houve uma exceção ao tentar se comunicar com o daemon, resultando em um código de resposta de código HTTP /:. Esta exceção foi registrada.',
    'node' => [
        'servers_attached' => 'Um nódulo não deve ter servidores vinculados a ele para ser excluído.',
        'daemon_off_config_updated' => 'A configuração do daemon <strong> foi atualizada </strong>, no entanto, ocorreu um erro ao tentar atualizar automaticamente o arquivo de configuração no Daemon. Você precisará atualizar manualmente o arquivo de configuração (core.json) para o daemon para aplicar essas alterações.',
    ],
    'allocations' => [
        'server_using' => 'Um servidor está atualmente atribuído a essa alocação. Uma alocação só pode ser excluída se nenhum servidor estiver atribuído no momento.',
        'too_many_ports' => 'Não há suporte para adicionar mais de 1000 portas em um único intervalo de uma vez.',
        'invalid_mapping' => 'O mapeamento fornecido para :port era inválido e não pôde ser processado.',
        'cidr_out_of_range' => 'A notação CIDR permite apenas máscaras entre /25 e /32.',
        'port_out_of_range' => 'As portas em uma alocação devem ser maiores que 1024 e menores ou iguais a 65535.',
    ],
    'nest' => [
        'delete_has_servers' => 'Um ninho com servidores ativos conectados a ele não pode ser excluído do painel.',
        'egg' => [
            'delete_has_servers' => 'Um Ovo com servidores ativos conectados a ele não pode ser excluído do Painel.',
            'invalid_copy_id' => 'O Egg selecionado para copiar um script não existe ou está copiando um script em si.',
            'must_be_child' => 'A diretiva "Copiar configurações de" para este ovo deve ser uma opção filho para o ninho selecionado.',
            'has_children' => 'Este ovo é o pai de um ou mais outros ovos. Por favor, apague esses ovos antes de apagar este ovo.',
        ],
        'variables' => [
            'env_not_unique' => 'A variável de ambiente :name deve ser exclusiva para este ovo.',
            'reserved_name' => 'A variável de ambiente :name está protegida e não pode ser atribuída a uma variável.',
            'bad_validation_rule' => 'A regra de validação ":rule" não é uma regra válida para este aplicativo.',
        ],
        'importer' => [
            'json_error' => 'Ocorreu um erro ao tentar analisar o arquivo JSON:: error.',
            'file_error' => 'O arquivo JSON fornecido não era válido.',
            'invalid_json_provided' => 'O arquivo JSON fornecido não está em um formato que possa ser reconhecido.',
        ],
    ],
    'packs' => [
        'delete_has_servers' => 'Não é possível excluir um pacote anexado aos servidores ativos.',
        'update_has_servers' => 'Não é possível modificar o ID da opção associada quando os servidores estão atualmente conectados a um pacote.',
        'invalid_upload' => 'O arquivo fornecido não parece ser válido.',
        'invalid_mime' => 'O arquivo fornecido não atende ao tipo necessário :type',
        'unreadable' => 'O arquivo fornecido não pôde ser aberto pelo servidor.',
        'zip_extraction' => 'Uma exceção foi encontrada ao tentar extrair o arquivo fornecido no servidor.',
        'invalid_archive_exception' => 'O arquivo do pacote fornecido parece estar ausente no arquivo archive.tar.gz ou import.json necessário no diretório base.',
    ],
    'subusers' => [
        'editing_self' => 'Não é permitido editar sua própria conta de subusuário.',
        'user_is_owner' => 'Você não pode adicionar o proprietário do servidor como um subusuário para este servidor.',
        'subuser_exists' => 'Um usuário com esse endereço de email já está atribuído como um subusuário para este servidor.',
    ],
    'databases' => [
        'delete_has_databases' => 'Não é possível excluir um servidor host de banco de dados que possui bancos de dados ativos vinculados a ele.',
    ],
    'tasks' => [
        'chain_interval_too_long' => 'O tempo máximo de intervalo para uma tarefa encadeada é de 15 minutos.',
    ],
    'locations' => [
        'has_nodes' => 'Não é possível excluir um local que tenha nódulos ativos anexados.',
    ],
    'users' => [
        'node_revocation_failed' => 'Falha ao revogar chaves no <a href=":link">Node #:node</a>. :error',
    ],
    'deployment' => [
        'no_viable_nodes' => 'Nenhum nódulo que atenda aos requisitos especificados para implantação automática foi encontrado.',
        'no_viable_allocations' => 'Nenhuma alocação que atenda aos requisitos de implantação automática foi encontrada.',
    ],
    'api' => [
        'resource_not_found' => 'O recurso solicitado não existe neste servidor.',
    ],
];
