<?php
/**
 * Pterodactyl - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */

return [
    'notices' => [
        'created' => 'Um novo ninho, :name, foi criado com sucesso.',
        'deleted' => 'Excluiu com êxito o ninho solicitado do Painel.',
        'updated' => 'Atualizadas com sucesso as opções de configuração do ninho.',
    ],
    'eggs' => [
        'notices' => [
            'imported' => 'Importou com sucesso este Ovo e suas variáveis associadas.',
            'updated_via_import' => 'Este Ovo foi atualizado usando o arquivo fornecido.',
            'deleted' => 'O Ovo solicitado foi excluído com sucesso do painel.',
            'updated' => 'A configuração do Ovo foi atualizada com sucesso.',
            'script_updated' => 'O script de instalação do Ovo foi atualizado e será executado sempre que os servidores estiverem instalados.',
            'egg_created' => 'Um novo Ovo foi colocado com sucesso. Você precisará reiniciar todos os daemons em execução para aplicar este novo ovo.',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => 'A variável ":variable" foi excluída e não estará mais disponível para os servidores após a reconstrução.',
            'variable_updated' => 'A variável ":variable" foi atualizada. Você precisará reconstruir qualquer servidor usando essa variável para aplicar as alterações.',
            'variable_created' => 'Nova variável foi criada e atribuída com sucesso a este ovo.',
        ],
    ],
];
