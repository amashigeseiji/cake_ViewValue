<?php
/**
 * EvaluateViewValue Class
 *
 * this class implements CakeEventListener class.
 *
 * @package		ViewValue
 * @author		Seiji Amashige <tenjuu99@gmail.com>
 * @version		1.0
 */

App::uses('ViewValueFactory', 'ViewValue.Lib');
App::uses('CakeEventListener', 'Event');

class EvaluateViewValue implements CakeEventListener {

/**
 * implementedEvents
 *
 * @return void
 * @see CakeEventListener::implementedEvents()
 */
	public function implementedEvents() {
		return array(
			'ViewValue.beforeEvaluate' => array(
				'callable' => 'beforeEvaluate',
				'passParams' => true
			)
		);
	}

/**
 * beforeEvaluate
 *
 * callback method
 *
 * @param array &$dataForView data for view file
 * @param bool $escapeFlag do not sanitize if escapeFlag is false
 * @return void
 */
	public function beforeEvaluate(&$dataForView, $escapeFlag = true) {
		if ($escapeFlag) {
			foreach ($dataForView as $name => &$value) {
				$value = ViewValueFactory::create($value, $name);
			}
		}
	}
}
