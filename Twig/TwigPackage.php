<?php

class TwigPackage extends Package
{
	function getPackageName()
	{
		return 'Twig';
	}

	function registerClassLoaders()
	{
		return array(
			new PearClassLoader(array('Twig'), array(dirname(__FILE__)))
		);
	}

	function registerWiring(IContainerBuilder $container)
	{
		$container->setConstant('twig.options.auto_reload', true);

		$container->define('twig_loader_service')
			->setClass('Twig_Loader_Filesystem')
			->addArgument('constant', 'view.paths');

		$container->define('twig_escaper_service')
			->setClass('Twig_Extension_Escaper')
			->addArgument('value', true);

		$container->define('twig_environment_service')
			->setClass('Twig_Environment')
			->setArguments(array(
				array('component', 'twig_loader_service'),
				array('array', array(
					'cache'       => array('constant', 'application.cache'),
					'debug'       => array('constant', 'application.debug'),
					'auto_reload' => array('constant', 'twig.options.auto_reload'),
				)),
			))->addMethod('addExtension', array(array('component', 'twig_escaper_service')));
	}

	function registerPaths()
	{

	}
}
