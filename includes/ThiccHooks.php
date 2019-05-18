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

	/**
	 * Adds the required table storing votes into the database when the
	 * end-user (sysadmin) runs /maintenance/update.php
	 *
	 * @param DatabaseUpdater $updater
	 */
	public static function onLoadExtensionSchemaUpdates( $updater ) {
		$patchPath = __DIR__ . '/../sql/';

		$updater->addExtensionTable(
			'thicc_threads',
			$patchPath . 'create-table--thicc-threads.sql'
		);
	}

}
