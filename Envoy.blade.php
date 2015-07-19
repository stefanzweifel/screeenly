@servers(['web' => 'wnxbash@sagitta.uberspace.de'])

@setup
    $repo        = 'git@github.com:stefanzweifel/screeenly.git';
    $release_dir = '/var/www/virtual/wnxbash/html/screeenly/releases';
    $app_dir     = '/var/www/virtual/wnxbash/html/screeenly/app';
    $release     = 'release_' . date('Ymd_His');
    $maxDeploys  = 10;
    $domain      = 'screeenly.com';
    $branch      = "master";

    // Fallback zu alter Installation
    // ln -s /var/www/virtual/wnxbash/html/screeenly.com/public/ /var/www/virtual/wnxbash/screeenly.com
@endsetup

/**
 * Kudos to: https://serversforhackers.com/video/enhancing-envoy-deployment
 */

@macro('down', ['on' => 'web'])
    shut_down_app
@endmacro

@macro('up', ['on' => 'web'])
    up_app
@endmacro

@macro('deploy', ['on' => 'web'])
    fetch_repo
    run_composer
    update_permissions
    update_symlinks
    route_cache
    {{-- move_old_release --}}
@endmacro

//////

@task('fetch_repo')
    echo "Start Script";
    [ -d {{ $release_dir }} ] || mkdir {{ $release_dir }};
    cd {{ $release_dir }};
    /home/wnxbash/.linuxbrew/bin/git clone -b {{ $branch }} --depth=1 {{ $repo }} {{ $release }};
    echo "✓ Repo cloned".;
@endtask

@task('run_composer')
    cd {{ $release_dir }}/{{ $release }};
    /home/wnxbash/html/composer.phar install --prefer-dist --no-scripts;
    php artisan clear-compiled --env=production;
    php artisan optimize --env=production;
@endtask

@task('update_symlinks')
    rm -rf {{ $app_dir }};
    ln -nfs {{ $release_dir }}/{{ $release }} {{ $app_dir }};
    chgrp -h wnxbash {{ $app_dir }};

    rm -rf /var/www/virtual/wnxbash/{{ $domain }};
    {{-- ln -nfs {{ $app_dir }}/public /var/www/virtual/wnxbash/{{ $domain }}; --}}
    ln -nfs {{ $release_dir }}/{{ $release }}/public /var/www/virtual/wnxbash/{{ $domain }};

    cd {{ $release_dir }}/{{ $release }};
    ln -nfs /var/www/virtual/wnxbash/html/screeenly/.env .env;
    chgrp -h wnxbash .env;

    rm -rf {{ $release_dir }}/{{ $release }}/storage/logs;
    cd {{ $release_dir }}/{{ $release }}/storage;
    ln -nfs /var/www/virtual/wnxbash/html/screeenly/logs logs;
    chgrp -h wnxbash logs;

    rm -rf {{ $release_dir }}/{{ $release }}/storage/framework/sessions;
    cd {{ $release_dir }}/{{ $release }}/storage/framework;
    ln -nfs /var/www/virtual/wnxbash/html/screeenly/sessions sessions;
    chgrp -h wnxbash sessions;

    cd {{ $release_dir }}/{{ $release }}/public/;
    rm -rf {{ $release_dir }}/{{ $release }}/public/images;
    ln -nfs /var/www/virtual/wnxbash/html/screeenly/images images;
    chgrp -h wnxbash images;

    cd {{ $release_dir }}/{{ $release }}/bin/;
    ln -nfs /var/www/virtual/wnxbash/html/screeenly/bin/phantomjs phantomjs;

    echo "--- ✓ Deployment done ---";
@endtask

@task('update_permissions')
    cd {{ $release_dir }};
    chgrp -R wnxbash {{ $release }};
    chmod -R ug+rwx {{ $release }};
@endtask

@task('move_old_release')
    cd {{ $release_dir }};
    mv !({{ $release }}) /var/www/virtual/wnxbash/html/screeenly/old_releases/
@endtask

/**
 * Equivalent to `php artisan down`
 */
@task('shut_down_app', ['on' => 'web'])
    cd {{ $app_dir }};
    pwd;
    php artisan down;
@endtask

/**
 * Equivalent to `php artisan up`
 */
@task('up_app', ['on' => 'web'])
    cd {{ $app_dir }};
    pwd;
    php artisan up;
@endtask

/**
 * Remove unused releases from the server
 */
@task('remove_old_releases', ['on' => 'web'])
    echo "remove old release";
    cd {{ $release_dir }};
    {{-- ls -1tr | head -n -2 | while read f; do echo "$f"; rm -rf "$f"; done; --}}
    {{-- ls -1tr | head -n -2 | while read f; do echo "$f"; done; --}}
@endtask

@task('route_cache', ['on' => 'web'])
    cd {{ $release_dir }}/{{ $release }};
    php artisan route:cache;
@endtask