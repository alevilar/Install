<?php

App::uses('InstallAppModel', 'Install.Model');



class SitesUser extends InstallAppModel {

    /**
     * name
     *
     * @var string
     */
    public $name = 'SitesUser';

    /**
     * useTable
     *
     * @var string
     */
    public $useTable = "sites_users";

    /**
     *
     * @var CroogoPlugin
     */
    protected $_CroogoPlugin = null;

    /**
     * Create admin user
     *
     * @var array $user User datas
     * @return If user is created
     */



}
