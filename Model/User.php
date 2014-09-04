<?php

App::uses('UsersAppModel', 'Install.Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User
 *
 * @category Model
 * @package  Croogo.Users.Model
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class User extends UsersAppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'User';

/**
 * Order
 *
 * @var string
 * @access public
 */
	public $order = 'User.username ASC';

/**
 * Behaviors used by the Model
 *
 * @var array
 * @access public
 */
	public $actsAs = array(

	);

/**
 * Model associations: belongsTo
 *
 * @var array
 * @access public
 */
	//public $belongsTo = array('Users.Role');

/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		'username' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Este usuario ya existe.',
				'last' => true,
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo ya no puede estar vacio.',
				'last' => true,
			),
		),

	);

/**
 * Filter search fields
 *
 * @var array
 * @access public
 */


/**
 * Display fields for this model
 *
 * @var array
 */
/**
 * Edit fields for this model
 *
 * @var array
 */

/**
 * beforeDelete
 *
 * @param boolean $cascade
 * @return boolean
 */
	public function beforeDelete($cascade = true) {
		$this->Role->Behaviors->attach('Croogo.Aliasable');
		$adminRoleId = $this->Role->byAlias('admin');

		$current = AuthComponent::user();
		if (!empty($current['id']) && $current['id'] == $this->id) {
			return false;
		}
		if ($this->field('role_id') == $adminRoleId) {
			$count = $this->find('count', array(
				'conditions' => array(
					'User.id <>' => $this->id,
					'User.role_id' => $adminRoleId,
					'User.status' => true,
				)
			));
			return ($count > 0);
		}
		return true;
	}

/**
 * beforeSave
 *
 * @param array $options
 * @return boolean
 */
	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

/**
 * _identical
 *
 * @param string $check
 * @return boolean
 * @deprecated Protected validation methods are no longer supported
 */
	protected function _identical($check) {
		return $this->validIdentical($check);
	}

/**
 * validIdentical
 *
 * @param string $check
 * @return boolean
 */
	public function validIdentical($check) {
		if (isset($this->data['User']['password'])) {
			if ($this->data['User']['password'] != $check['verify_password']) {
				return __d('croogo', 'Los password no coinciden, favor reintente.');
			}
		}
		return true;
	}

}
