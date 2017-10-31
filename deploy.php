<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'https://github.com/Symfomany/deployer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


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

// Task
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

