﻿<?php

return [
    'key' => [
        'warning' => 'Parece que você já configurou uma chave de criptografia de aplicativo. Continuar esse processo substituindo essa chave e causando corrupção de dados para quaisquer dados criptografados existentes. NÃO CONTINUE A MENOS QUE VOCÊ SAIBA O QUE ESTÁ FAZENDO.',
        'confirm' => 'Entendo as consequências de executar este comando e aceito toda a responsabilidade pela perda de dados criptografados.',
        'final_confirm' => 'Tem certeza que deseja continuar? Alterar a chave de criptografia do aplicativo CAUSARÁ PERDA DE DADOS.',
    ],
    'location' => [
        'no_location_found' => 'Não foi possível localizar um registro que corresponda ao código curto fornecido.',
        'ask_short' => 'Código de Localização Curto',
        'ask_long' => 'Descrição da Localização',
        'created' => 'Criou com êxito um novo local (:name) com um ID :id.',
        'deleted' => 'Excluiu com êxito o local solicitado.',
    ],
    'user' => [
        'search_users' => 'Digite um nome de usuário, UUID, ou endereço de email',
        'select_search_user' => 'ID do usuário a ser excluído (Digite \'0\' para pesquisar novamente)',
        'deleted' => 'Usuário excluído com sucesso do painel.',
        'confirm_delete' => 'Tem certeza de que deseja excluir este usuário do painel?',
        'no_users_found' => 'Nenhum usuário foi encontrado para o termo de pesquisa fornecido.',
        'multiple_found' => 'Foram encontradas várias contas para o usuário fornecido, incapaz de excluir um usuário devido ao sinalizador --no-interaction.',
        'ask_admin' => 'Este usuário é um administrador?',
        'ask_email' => 'Endereço de e-mail',
        'ask_username' => 'Nome de Usuário',
        'ask_name_first' => 'Primeiro Nome',
        'ask_name_last' => 'Último Nome',
        'ask_password' => 'Senha',
        'ask_password_tip' => 'Se você deseja criar uma conta com uma senha aleatória enviada por e-mail ao usuário, execute novamente este comando (CTRL + C) e passe o sinalizador `--no-password`.',
        'ask_password_help' => 'As senhas devem ter pelo menos 8 caracteres e conter pelo menos uma letra maiúscula e um número.',
        '2fa_help_text' => [
            'Este comando desativará a autenticação de dois fatores para a conta de um usuário, se estiver ativada. Isso só deve ser usado como um comando de recuperação de conta se o usuário estiver bloqueado da conta.',
            'Se não era o que você queria fazer, pressione CTRL + C para sair desse processo.',
        ],
        '2fa_disabled' => 'A autenticação de 2 fatores foi desativada para :email.',
    ],
    'schedule' => [
        'output_line' => 'Despachando o trabalho para a primeira tarefa em `:schedule` (:hash).',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'Excluindo arquivo de backup de serviço :file.',
    ],
    'server' => [
        'rebuild_failed' => 'A solicitação de reconstrução para ":name" (#:id) no nódulo ":node" falhou com o erro: :message',
        'reinstall' => [
            'failed' => 'Reinstale a solicitação para ":name" (#:id) no nódulo ":node" falhou com o erro: :message',
            'confirm' => 'Você está prestes a reinstalar em um grupo de servidores. Você deseja continuar?',
        ],
        'power' => [
            'confirm' => 'Você está prestes a executar uma :action contra :count servidores. Você deseja continuar?',
            'action_failed' => 'A solicitação de ação de energia para ":name" (#:id) no nódulo ":node" falhou com erro: :message',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'Host SMTP (por exemplo, smtp.gmail.com)',
            'ask_smtp_port' => 'Porta SMTP',
            'ask_smtp_username' => 'Nome de usuário SMTP',
            'ask_smtp_password' => 'Senha SMTP',
            'ask_mailgun_domain' => 'Domínio Mailgun',
            'ask_mailgun_secret' => 'Segredo Mailgun',
            'ask_mandrill_secret' => 'Segredo Mandrill',
            'ask_postmark_username' => 'Chave da API do Postmark',
            'ask_driver' => 'Qual driver deve ser usado para enviar emails?',
            'ask_mail_from' => 'Os endereços de email devem ser originários de',
            'ask_mail_name' => 'Nome do qual os emails devem aparecer',
            'ask_encryption' => 'Método de criptografia a ser usado',
        ],
        'database' => [
            'host_warning' => 'É altamente recomendável não usar "localhost" como seu host de banco de dados, pois vimos problemas frequentes de conexão de soquete. Se você deseja usar uma conexão local, deve usar "127.0.0.1".',
            'host' => 'Host do Banco de Dados',
            'port' => 'Porta do Banco de Dados',
            'database' => 'Nome do Banco de Dados',
            'username_warning' => 'O uso da conta "root" para conexões MySQL não é apenas altamente desaprovada, como também não é permitido por este aplicativo. Você precisará ter criado um usuário MySQL para este software.',
            'username' => 'Nome de usuário do Banco de Dados',
            'password_defined' => 'Parece que você já tem uma senha de conexão MySQL definida, gostaria de alterá-la?',
            'password' => 'Senha do Banco de Dados',
            'connection_error' => 'Não foi possível conectar ao servidor MySQL usando as credenciais fornecidas. O erro retornado foi ":error".',
            'creds_not_saved' => 'Suas credenciais de conexão NÃO foram salvas. Você precisará fornecer informações de conexão válidas antes de continuar.',
            'try_again' => 'Voltar e tentar novamente?',
        ],
        'app' => [
            'settings' => 'Ativar editor de configurações com base na interface do usuário?',
            'author' => 'Email do Autor do Ovo',
            'author_help' => 'Forneça o endereço de e-mail de onde devem ser os ovos exportados por este painel. Este deve ser um endereço de email válido.',
            'app_url_help' => 'O URL do aplicativo DEVE começar com https:// ou http://, dependendo se você estiver usando SSL ou não. Se você não incluir o esquema, seus e-mails e outros conteúdos serão vinculados ao local errado.',
            'app_url' => 'URL da aplicação',
            'timezone_help' => 'O fuso horário deve corresponder a um dos fusos horários suportados pelo PHP. Se você não tiver certeza, consulte http://php.net/manual/en/timezones.php.',
            'timezone' => 'Fuso horário da aplicação',
            'cache_driver' => 'Driver de Cache',
            'session_driver' => 'Driver de Sessão',
            'queue_driver' => 'Driver de Fila',
            'using_redis' => 'Você selecionou o driver Redis para uma ou mais opções, forneça informações de conexão válidas abaixo. Na maioria dos casos, você pode usar os padrões fornecidos, a menos que tenha modificado sua configuração.',
            'redis_host' => 'Host Redis',
            'redis_password' => 'Senha Redis',
            'redis_pass_help' => 'Por padrão, uma instância do servidor Redis não tem senha, pois está sendo executada localmente e inacessível ao mundo externo. Se for esse o caso, basta pressionar enter sem inserir um valor.',
            'redis_port' => 'Porta Redis',
            'redis_pass_defined' => 'Parece que uma senha já está definida para o Redis. Deseja alterá-la?',
        ],
    ],
];