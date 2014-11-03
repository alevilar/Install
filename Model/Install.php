<?php

App::uses('CakeTime', 'Utility');
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

    public $validate = array(
        'host' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'required' => true, 'allowEmpty' => false,
                'message' => 'Favor ingresar un nombre de Host.'
            ),
            'characters' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
                'message'  => 'Solo se admiten caracteres alfanuméricos con/sin espacios para el nombre del host.'
            )
        ),
        'login' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'required' => true, 'allowEmpty' => false,
                'message' => 'Favor ingresar un nombre de Usuario.'
            ),
            'characters' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
                'message'  => 'Solo se admiten caracteres alfanuméricos con/sin espacios para el nombre del usuario.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'required' => true, 'allowEmpty' => false,
                'message' => 'Favor ingresar un nombre de Contraseña.'
            ),
            'characters' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
                'message'  => 'Solo se admiten caracteres alfanuméricos con/sin espacios para la contraseña.'
            )
        ),
        'database' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'required' => true, 'allowEmpty' => false,
                'message' => 'Favor de ingresar un nombre de Base de Datos.'
            ),
            'characters' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
                'message'  => 'Solo se admiten caracteres alfanuméricos con/sin espacios para el nombre de Base de Datos.'
            )
        ),
    );
}
