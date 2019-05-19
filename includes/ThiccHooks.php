<?php
/**
 * Thicc extension hooks
 *
 * @file
 * @ingroup Extensions
 * @license GPL-2.0+
 */
class ThiccHooks {

	/**
	 * Conditionally register the unit testing module for the ext.thicc module
	 * only if that module is loaded
	 *
	 * @param array $testModules The array of registered test modules
	 * @param ResourceLoader $resourceLoader The reference to the resource loader
	 */
	public static function onResourceLoaderTestModules( array &$testModules, ResourceLoader &$resourceLoader ) {
		$testModules['qunit']['ext.thicc.tests'] = [
			'scripts' => [
				'tests/Thicc.test.js'
			],
			'dependencies' => [
				'ext.thicc'
			],
			'localBasePath' => __DIR__,
			'remoteExtPath' => 'Thicc',
		];
	}

}
