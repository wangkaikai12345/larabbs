<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'larabbs');

// Project repository
set('repository', 'git@github.com:wangkaikai12345/larabbs.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// 实践证明，这样能减少一些不必要的麻烦,如出现权限相关的问题，也可将此项设置为 true 后尝试
set('writable_use_sudo', false);


// Hosts

//host('39.107.77.158')
//    ->user('deployer')
//    ->identityFile('~/.ssh/deployerkey')
//    ->set('deploy_path', '/var/www/{{application}}')
//    ->set('branch', 'master');

host('132.232.36.212')
    ->user('root')
    ->set('deploy_path', '/var/www/{{application}}')
    ->set('branch', 'master');

// Tasks
task('artisan:config:cache', function () {
    return true;
});

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:optimize');
//after('artisan:optimize', 'artisan:migrate');

