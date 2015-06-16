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
App::uses('StringValue', 'ViewValue.Lib');

class ArrayValue extends BaseViewValue Implements ArrayAccess, IteratorAggregate {

	protected $type = 'array';

/**
 * _sanitizeRecursive
 *
 * sanitize given value recursively
 * @param array $value
 * @return array sanitized
 */
	protected static function _sanitize($value) {
		if (is_string($value)) {
			return new StringValue($value);
		} elseif (is_array($value)) {
			return new self($value);
		}
		return $value;
	}

/**
 * getIterator
 *
 * generator
 */
	public function getIterator() {
		foreach ($this->value as $key => $value) {
			yield $key => $this->_sanitize($value);
		}
	}

/**
 * offsetGet
 *
 * @param string|int $key
 * @return mixed|null
 */
	public function offsetGet($key) {
		return $this->offsetExists($key) ? $this->_sanitize($this->value[$key]) : null;
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
