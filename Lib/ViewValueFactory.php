<?php
/**
 * ViewValueFactory Class
 *
 * sanitize view value by default
 *
 * @package		ViewValue
 * @author		Seiji Amashige <tenjuu99@gmail.com>
 */

App::uses('StringViewValue', 'ViewValue.Lib/ViewValue');
App::uses('ArrayViewValue', 'ViewValue.Lib/ViewValue');
App::uses('ObjectViewValue', 'ViewValue.Lib/ViewValue');

class ViewValueFactory {

/**
 * factory method
 *
 * @param mixed $value value
 * @return BaseViewValue|mixed
 */
	public static function create($value) {
		if ($value instanceof BaseViewValue) {
			return $value;
		}

		$type = gettype($value);
		$className = ucfirst($type) . 'ViewValue';
		if (class_exists($className)) {
			return new $className($value);
		}

		return $value;
	}
}
