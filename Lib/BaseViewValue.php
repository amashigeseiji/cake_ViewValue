<?php
/**
 * BaseViewValue Class
 *
 * this class is abstract class.
 *
 * @package		ViewValue
 * @author		Seiji Amashige <amasihge@startbahn.jp>
 * @version		1.0
 **/

abstract class BaseViewValue {

	protected $value = null;

	protected $clean = null;

	protected $type;

/**
 * constructor
 *
 * @param mixed value
 * @throws RuntimeException
 */
	public function __construct(&$value) {
		if (gettype($value) !== $this->type) {
			throw new RuntimeException('type is not expected.');
		}
		$this->value = $value;
		if (method_exists($this, 'initialize')) {
			$this->initialize($value);
		}
	}

/**
 * _sanitize
 *
 * sanitize given value
 * @param string $value
 * @return string sanitized
 */
	protected static function _sanitize($value) {
		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	}

/**
 * clean
 *
 * sanitize given value
 * @param string $value
 * @return string sanitized value
 */
	public function clean() {
		if (!$this->clean) {
			$this->clean = $this->_sanitize($this->value);
		}
		return $this->clean;
	}

	protected function doClean($value = null) {
		return $value ? self::_sanitize($value) : self::_sanitize($this->value);
	}

/**
 * raw
 *
 * @return string sanitized
 */
	protected function raw() {
		return $this->value;
	}
}
