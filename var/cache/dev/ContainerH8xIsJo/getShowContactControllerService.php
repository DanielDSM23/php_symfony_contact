<?php

namespace ContainerH8xIsJo;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getShowContactControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\ShowContactController' shared autowired service.
     *
     * @return \App\Controller\ShowContactController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/ShowContactController.php';

        $container->services['App\\Controller\\ShowContactController'] = $instance = new \App\Controller\ShowContactController();

        $instance->setContainer(($container->privates['.service_locator.jIxfAsi'] ?? $container->load('get_ServiceLocator_JIxfAsiService'))->withContext('App\\Controller\\ShowContactController', $container));

        return $instance;
    }
}
