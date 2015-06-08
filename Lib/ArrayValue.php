<?php
/**
 * ArrayValue Class
 *
 * Sanitize array view value by default.
 * This class extends BaseViewValue class
 * and implements ArrayAccess, IteratorAggregate.
 *
 * @package		ViewValue
 * @author		Seiji Amashige <amasihge@startbahn.jp>
 * @version		1.0
 */
App::uses('BaseViewValue', 'ViewValue.Lib');
App::uses('StringViewValue', 'ViewValue.Lib');

class ArrayValue extends BaseViewValue Implements ArrayAccess, IteratorAggregate {

	protected $type = 'array';

/**
 * _sanitizeRecursive
 *
 * sanitize given value recursively
 * @param array $value
 * @return array sanitized
 */
	protected static function _sanitize(Array $value) {
		array_walk_recursive($value, 'self::__sanitizeStringByRef');
		return $value;
	}

/**
 * __sanitizeStringByRef
 *
 * @param string &$value
 * @return string sanitized
 * @todo sanitize object
 */
	private static function __sanitizeStringByRef(&$value) {
		if (is_string($value)) {
			$value = parent::_sanitize($value);
		}
		return $value;
	}

/**
 * @see BaseViewValue::doClean()
 */
	protected function doClean($value = null) {
		return $value ? self::_sanitizeRecursive($value) : self::_sanitizeRecursive($this->value);
	}

/**
 * getIterator
 */
	public function getIterator() {
		return new ArrayObject($this->clean());
	}

/**
 * offsetGet
 *
 * @param string|int $key
 * @return mixed|null
 */
	public function offsetGet($key) {
		return $this->offsetExists($key) ? $this->clean()[$key] : null;
	}

/**
 * offsetSet
 *
 * this instance value cannot be updated.
 * @param string|int $key
 * @param mixed $value
 * @throws LogicException
 */
	public function offsetSet($key, $value = null) {
		throw new LogicException(__METHOD__.' is not allowed.');
	}

/**
 * offsetExists
 *
 * @param string|int $key
 * @return bool
 */
	public function offsetExists($key) {
		return isset($this->value[$key]);
	}

/**
 * offsetUnset
 *
 * @param string|int $key
 * @return void
 */
	public function offsetUnset($key) {
		unset($this->value[$key]);
	}
}
