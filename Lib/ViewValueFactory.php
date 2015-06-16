<?php
/**
 * ViewValueFactory Class
 *
 * sanitize view value by default
 *
 * @package		ViewValue
 * @author		Seiji Amashige <tenjuu99@gmail.com>
 * @version		1.0
 */

App::uses('StringViewValue', 'ViewValue.Lib/ViewValue');
App::uses('ArrayViewValue', 'ViewValue.Lib/ViewValue');
App::uses('ObjectViewValue', 'ViewValue.Lib/ViewValue');

class ViewValueFactory {

/**
 * factory method
 *
 * @param mixed $value value
 * @param string|null $name variable name
 * @return BaseViewValue|mixed
 */
	public static function create($value, $name = null) {
		if ($name === 'content_for_layout' ||
			$name === 'scripts_for_layout' ||
			is_null($value) || is_bool($value) || is_numeric($value)) {
			return $value;
		}

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
