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
 * isDebugKitVariable
 *
 * @param string $name
 * @return bool
 */
	private function isDebugKitVariable($name) {
		if (!isset($this->isDebugKit)) {
			$this->isDebugKit = CakePlugin::loaded('DebugKit') && Configure::read('debug');
		}
		return $this->isDebugKit && preg_match('/debugToolbar/', $name);
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
				if (!$this->isDebugKitVariable($name)) {
					$value = ViewValueFactory::create($value);
				}
			}
		}
	}
}
