<?php
/**
 * All ViewValue plugin tests
 */
class AllViewValueTest extends CakeTestCase {

/**
 * Suite define the tests for this plugin
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All ViewValue test');

		$path = CakePlugin::path('ViewValue') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}

}
