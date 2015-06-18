<?php
/**
 * ObjectViewValue Class
 *
 * @package		ViewValue
 * @author		Seiji Amashige <tenjuu99@gmail.com>
 */

App::uses('BaseViewValue', 'ViewValue.Lib/ViewValue');

class ObjectViewValue extends BaseViewValue {

	protected $_type = 'object';

/**
 * __get magic method
 *
 * @param string $key object property
 * @return BaseViewValue|null|bool|numeric|void
 */
	public function __get($key) {
		if (isset($this->_value, $key)) {
			return ViewValueFactory::create($this->_value->$key);
		}
	}

/**
 * __call magic method
 *
 * @param string $name method name
 * @param array $args method arguments
 * @return BaseViewValue|null|bool|numeric
 * @throws BadMethodCallException
 */
	public function __call($name, $args = null) {
		$method = array($this->_value, $name);
		if (is_callable($method)) {
			return ViewValueFactory::create(call_user_func_array($method, $args));
		}
		throw new BadMethodCallException();
	}
}
