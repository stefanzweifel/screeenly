<?php

namespace Deployer;

require 'recipe/laravel.php';

require __DIR__.'/vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__.'/');
$dotenv->load();

// Configuration

set('repository', 'git@github.com:stefanzweifel/screeenly.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('screeenly.com')
    ->stage('production')
    ->set('deploy_path', getenv('DEPLOY_PATH_PRODUTION'));

host('stage.screeenly.com')
    ->stage('stage')
    ->set('deploy_path', getenv('DEPLOY_PATH_STAGE'));

// Tasks

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');
