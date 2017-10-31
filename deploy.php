<?php
namespace Deployer;

require 'recipe/symfony3.php';
// Doc: https://github.com/deployphp/deployer/blob/master/recipe/symfony3.php
// Doc 2: https://github.com/deployphp/deployer/blob/master/recipe/common.php


// Project name
set('application', 'my_project');

// Project repository
set('repository', 'https://github.com/Symfomany/deployer.git');

// this number by modifying the associated parameter:
set('keep_releases', 10);


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


// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');


// Migrate database before symlink new release.
// before('deploy:symlink', 'database:migrate');

