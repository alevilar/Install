<?php
App::uses('Installer', 'Install.Utility');

$request = Router::getRequest();

if ($request && strpos($request->url, 'install') === false) {
    if(
        file_exists(APP . 'Config' . DS . 'database.php')==false
        ||file_exists(APP . 'Config' . DS . 'core.php')==false
        || Installer::checkAppInstalled() == false
    )
    {

        $url = array('plugin' => 'install', 'controller' => 'install');

        Router::redirect('/*', $url, array('status' => 307));
    }
 }
