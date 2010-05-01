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
	 * user needs to define a pdo_service and classes + outlet.dialect constants
	 *
	 * @param IContainerBuilder $container
	 */
	public function registerWiring(IContainerBuilder $container)
	{
		$container->define('outlet_service')
			->setClass('Outlet')
			->addArgument('array', array(
				'connection' => array('array', array(
					'pdo'     => array('component', 'pdo_service'),
					'dialect' => array('constant', 'outlet.dialect')
				)),
				'classes'    => array('constant', 'database.classes'),
			))->addMethod('createProxies');
	}
}
