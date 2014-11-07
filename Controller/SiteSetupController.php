<?php
App::uses('AppNoModelController', 'Controller');
App::uses('Installer', 'Install.Utility');

class SiteSetupController extends AppNoModelController {

    public $layout = 'Risto.default';
    public $uses = array("MtSites.Site");

    
}
