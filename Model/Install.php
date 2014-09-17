<?php

App::uses('CakeTime', 'Utility');
App::uses('DataMigration', 'Install.Lib/Utility');
App::uses('File', 'Utility');
App::uses('InstallAppModel', 'Install.Model');
App::uses('Security', 'Utility');


class Install extends InstallAppModel {

    /**
     * name
     *
     * @var string
     */
    public $name = 'Install';

    /**
     * useTable
     *
     * @var string
     */
    public $useTable = false;

    /**
     *
     * @var CroogoPlugin
     */

}
