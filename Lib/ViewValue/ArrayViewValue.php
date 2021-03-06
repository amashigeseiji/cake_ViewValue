<?php
/**
 * ArrayViewValue Class
 *
 * Sanitize array view value by default.
 * This class extends BaseViewValue class
 * and implements ArrayAccess, IteratorAggregate.
 *
 * @package		ViewValue
 * @author		Seiji Amashige <tenjuu99@gmail.com>
 */

App::uses('BaseViewValue', 'ViewValue.Lib/ViewValue');

class ArrayViewValue extends BaseViewValue implements ArrayAccess, IteratorAggregate, Countable {

	protected $_type = 'array';

/**
 * getIterator
 *
 * generator
 *
 * @return void
 */
	public function getIterator() {
		foreach ($this->_value as $key => $value) {
			yield $key => ViewValueFactory::create($value);
		}
	}

/**
 * offsetGet
 *
 * @param string|int $key offset
 * @return mixed|null
 */
	public function offsetGet($key) {
		return $this->offsetExists($key) ? ViewValueFactory::create($this->_value[$key]) : null;
	}

/**
 * offsetSet
 *
 * this instance value cannot be updated.
 *
 * @param string|int $key offset
 * @param mixed $value value
 * @return void
 * @throws LogicException
 */
	public function offsetSet($key, $value = null) {
		throw new LogicException(__METHOD__ . ' is not allowed.');
	}

/**
 * offsetExists
 *
 * @param string|int $key offset
 * @return bool
 */
	public function offsetExists($key) {
		return array_key_exists($key, $this->_value);
	}

/**
 * offsetUnset
 *
 * @param string|int $key offset
 * @return void
 */
	public function offsetUnset($key) {
		unset($this->_value[$key]);
	}

/**
 * countable
 *
 * @return int
 */
	public function count() {
		return count($this->_value);
	}
}
