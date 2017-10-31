<?php
namespace Deployer;

require 'recipe/symfony3.php';
// doc: https://github.com/deployphp/deployer/blob/master/recipe/symfony3.php

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'https://github.com/Symfomany/deployer.git');



// Hosts

// Hosts
host('54.36.181.203')
->set('deploy_path', '/var/www/html/symfony') // There to deploy application on remote host.
->user('root')
->port(22)
->identityFile('~/.ssh/id_rsa') // SSH Key
->forwardAgent(true)
->multiplexing(true)
->addSshOption('UserKnownHostsFile', '/dev/null')
->addSshOption('StrictHostKeyChecking', 'no');

/**
 * Main task
 */
task('deploying', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:clear_paths',
    'deploy:create_cache_dir',
    'deploy:shared',
    'deploy:assets',
    'deploy:vendors',
    'deploy:cache:clear',
    'deploy:cache:warmup',
    'deploy:writable',
    'deploy:symlink',
    'cleanup',
])->desc('Deploy your project...');
// Display success message on completion
after('deploying', 'success');


// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');


// Migrate database before symlink new release.
// before('deploy:symlink', 'database:migrate');

