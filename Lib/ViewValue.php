<?php
/**
 * ViewValue Class
 *
 * sanitize view value by default
 *
 * @package		ViewValue
 * @author		Seiji Amashige <amasihge@startbahn.jp>
 * @version		1.0
 */

App::uses('StringValue', 'ViewValue.Lib');
App::uses('ArrayValue', 'ViewValue.Lib');

class ViewValue {

/**
 * factory method
 *
 * @param mixed $value
 * @param string|null $name
 * @return mixed|BaseViewValue
 */
	public static function factory($value, $name = null) {
		if ($name === 'content_for_layout' ||
			$name === 'scripts_for_layout' ||
			is_null($value) || is_bool($value) || is_numeric($value)) {
			return $value;
		}

		if (is_array($value)) {
			return new ArrayValue($value);
		} elseif (is_string($value)) {
			return new StringValue($value);
		} elseif ($value instanceof BaseViewValue) {
			return $value;
		}
		return $value;
	}
}
