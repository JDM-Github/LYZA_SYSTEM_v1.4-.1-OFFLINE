<?php
namespace Deployer;

require 'recipe/common.php';


set('repository', 'https://github.com/JDM-Github/Lyza-Drugmart.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// NAH NAH NAH NAH
host('test.com')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/Lyza-Drugmart');


after('deploy:failed', 'deploy:unlock');
