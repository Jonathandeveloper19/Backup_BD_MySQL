<?php
header('Content-type: text/html; charset=utf-8 lang="es"');
set_time_limit(0);

require_once __DIR__.'/vendor/mysqldump-php/autoload.php';
require_once __DIR__.'/vendor/sftp/autoload.php';
require_once __DIR__.'/vendor/symfony/autoload.php';
require_once __DIR__.'/vendor/zip_archive/autoload.php';
$config = require_once __DIR__.'/config.php';
require_once __DIR__.'/function.php';
require_once 'vendor/phpmailer/autoload.php';

use Symfony\Component\Finder\Finder;

info(' ');

echo '<b>Iniciando</b><br>';

database_backup($config);

$dir = __DIR__.'/../h/';
$finder = new Finder();
$finder->files()->in($dir);

$source = get_source($finder, '/h/'.$fecha.'_'.$hora.'_'.$id.'/');
local_backup($config, $source);

$finder2 = new Finder();
$finder2->files()->in($dir)->exclude('upload');
$source2 = get_source($finder2);
//archive_backup($config, $source2);

sftp_backup($config, [
    '/backup/'.$config['database']['filename'].'.gz'  => $config['database']['target'].'/'.$config['database']['filename'].'.gz',
    // '/backup/'.basename($config['archive']['target']) => $config['archive']['target'],
]);

ftp_backup($config, [
    '/backup/'.$config['database']['filename'].'.gz'  => $config['database']['target'].'/'.$config['database']['filename'].'.gz',
    // '/backup/'.basename($config['archive']['target']) => $config['archive']['target'],
]);

send_mail($fecha,$hora);


echo '<b>Finalizado</b>';


exit;




