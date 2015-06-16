<?php
/**
 * StringViewValue Class
 *
 * this class extends BaseViewValue class.
 *
 * @package		ViewValue
 * @author		Seiji Amashige <tenjuu99@gmail.com>
 * @version		1.0
 */

App::uses('BaseViewValue', 'ViewValue.Lib/ViewValue');

class StringViewValue extends BaseViewValue {

	protected $_type = 'string';

	protected $_clean = null;

/**
 * __toString magic method
 *
 * StringViewValue class returns sanitized string value by default.
 *
 * @return string sanitized value
 */
	public function __toString() {
		return $this->clean();
	}

/**
 * clean
 *
 * sanitize given value
 *
 * @return string sanitized value
 */
	public function clean() {
		if (!$this->_clean) {
			$this->_clean = $this->_h($this->_value);
		}
		return $this->_clean;
	}
}
