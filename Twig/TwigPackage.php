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

	}

	function registerPaths()
	{

	}
}
