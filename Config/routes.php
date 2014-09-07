<?php

$request = Router::getRequest();

if (strpos($request->url, 'install') === false) {
    if(
        file_exists(APP . 'Config' . DS . 'database.php')==false
        ||file_exists(APP . 'Config' . DS . 'core.php')==false
        ||file_exists(APP . 'Config' . DS . 'risto.php')==false
        ||file_exists(APP . 'Config' . DS . 'resume.php')==false
    )
    {

        $url = array('plugin' => 'install', 'controller' => 'install');

        Router::redirect('/*', $url, array('status' => 307));
    }
 }
