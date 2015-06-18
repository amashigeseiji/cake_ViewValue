<?php
/**
 * ViewValueView Class
 *
 * Sanitize view value by default.
 * This class extends View class.
 *
 * @package		ViewValue
 * @author		Seiji Amashige <amasihge@startbahn.jp>
 */

App::uses('View', 'View');
App::uses('EvaluateViewValue', 'ViewValue.Lib');

class ViewValueView extends View {

/**
 * __escapeFlag
 * @access private
 */
	private $__escapeFlag = true;

/**
 * constructor
 *
 * @param Controller &$controller ControllerInstance
 * @return void
 * @see View::__construct()
 */
	public function __construct(&$controller) {
		parent::__construct($controller);
		if (property_exists($controller, 'escapeFlag')) {
			$this->__escapeFlag = $controller->escapeFlag;
		}
		$this->getEventManager()->attach(new EvaluateViewValue());
	}

/**
 * _evaluate
 *
 * @param string $viewFile View filename
 * @param array $dataForView data for view file
 * @return void
 * @see View::_evaluate()
 */
	protected function _evaluate($viewFile, $dataForView) {
		$this->_dispatchBeforeEvaluate($dataForView);
		return parent::_evaluate($viewFile, $dataForView);
	}

/**
 * dispatchBeforeEvaluate
 *
 * @param array &$data data for view file
 * @return void
 */
	protected function _dispatchBeforeEvaluate(&$data) {
		$this->getEventManager()->dispatch(new CakeEvent('ViewValue.beforeEvaluate', $this, array(
			'data' => &$data,
			'escapeFlag' => $this->__escapeFlag
		)));
	}
}
