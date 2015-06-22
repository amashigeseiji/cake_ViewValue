<?php
/**
 * ViewValueHelper Class
 *
 * Sanitize view value by default.
 *
 * @package		ViewValue
 * @author		Seiji Amashige <amasihge@startbahn.jp>
 */

App::uses('ViewValueFactory', 'ViewValue.Lib');

class ViewValueHelper extends AppHelper {

/**
 * isIgnoreVariable
 *
 * @param string $name variable name
 * @return bool
 */
	private function __isIgnoreVariable($name) {
		if (!property_exists($this, 'ignore')) {
			Configure::load('ViewValue.viewvalue');
			$this->ignore = implode('|', Configure::read('ViewValue.ignore'));
		}
		return preg_match('/^' . $this->ignore . '$/', $name);
	}

/**
 * beforeRender callback method
 *
 * overwrite View::viewVars
 *
 * @param string $viewFile filename of view
 * @return void
 */
	public function beforeRender($viewFile) {
		parent::beforeRender($viewFile);
		if (!isset($this->settings['escape'])) {
			$this->settings['escape'] = true;
		}
		if ($this->settings['escape']) {
			$this->_View->isEscaped = true;
			foreach ($this->_View->viewVars as $name => &$value) {
				if (!$this->__isIgnoreVariable($name)) {
					$value = ViewValueFactory::create($value);
				}
			}
		}
	}
}
