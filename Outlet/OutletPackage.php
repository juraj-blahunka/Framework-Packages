<?php

class OutletPackage extends Package
{
	public function getPackageName()
	{
		return 'Outlet';
	}

	public function registerClassLoaders()
	{
		return array(
			new FlatFolderClassLoader(dirname(__FILE__)),
		);
	}

	public function registerPaths()
	{
	}

	/**
	 * Register package wiring.
	 *
	 * Creates a new component declaration named "outlet_service",
	 * user needs to defined 2 constants:
	 *	database.connection
	 *  database.classes
	 *
	 * @param IContainerBuilder $container
	 */
	public function registerWiring(IContainerBuilder $container)
	{
		$container->define('outlet_service')
			->setClass('Outlet')
			->addArgument('array', array(
				'connection' => array('constant', 'database.connection'),
				'classes'    => array('constant', 'database.classes'),
			))->addMethod('createProxies');
	}
}
