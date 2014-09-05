<?php

$request = Router::getRequest();

if (strpos($request->url, 'install') === false&&!Configure::read('Risto.installed')) {
    $url = array('plugin' => 'install', 'controller' => 'install');

    Router::redirect('/*', $url, array('status' => 307));
}
