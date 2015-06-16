<?php
App::uses('ViewValue', 'ViewValue.Lib');
App::uses('CakeEventListener', 'Event');

class EvaluateViewValue implements CakeEventListener {

/**
 * implementedEvents
 */
	public function implementedEvents() {
		return array(
			'View.beforeEvaluate' => array(
				'callable' => 'beforeEvaluate',
				'passParams' => true
			)
		);
	}

/**
 * beforeEvaluate
 *
 * callback method
 */
	public function beforeEvaluate(&$dataForView, $escapeFlag = true) {
		if ($escapeFlag) {
			foreach ($dataForView as $name => &$value) {
				$value = ViewValue::factory($value, $name);
			}
		}
	}
}
