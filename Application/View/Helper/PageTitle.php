<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Exception;

/**
 * Helper to show page title
 */
class PageTitle extends AbstractHelper implements ServiceLocatorAwareInterface
{
    /**
     * Service locator
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Returns the page title
     *
     * @param string|null $namespace
     *
     * @return string
     */
    public function __invoke($namespace = null)
    {
        $routeMatch = $this->getRouteMatch();
        $controller = $routeMatch->getParam('__CONTROLLER__');
        $action = $routeMatch->getParam('action');

        $title = $this->getPageTitle($controller, $action);

        $viewHelper = $this->getHeadTitleHelper();
        $viewHelper->prepend($title);

        return $title;
    }

    /**
     * Get the route match.
     *
     * @return Zend\Mvc\Router\Http\RouteMatch
     */
    public function getRouteMatch()
    {
        $service = $this->getServiceLocator();
        $application = $service->getServiceLocator()->get('application');
        $routeMatch = $application->getMvcEvent()->getRouteMatch();

        return $routeMatch;
    }

    /**
     * Get the config params.
     *
     * @return array
     */
    public function getPageTitleConfig()
    {
        $service = $this->getServiceLocator();
        $config = $service->getServiceLocator()->get('Config');

        if (!isset($config['page_title'])) {
            throw new Exception\RuntimeException(
                'The file containing page_title settings can not be found.'
            );
        }

        return $config['page_title'];
    }

    /**
     * Get the page titles
     *
     * @param string $controller
     * @param string $action
     *
     * @return string
     */
    public function getPageTitle($controller, $action)
    {
        $titleConfig = $this->getPageTitleConfig();

        if (!isset($titleConfig[$controller][$action])) {
            return '';
        }

        return $titleConfig[$controller][$action];
    }

    /**
     * Get the View Helper
     *
     * @return Zend\View\Helper\HeadTitle
     */
    public function getHeadTitleHelper()
    {
        $service = $this->getServiceLocator();
        $viewHelperManager = $service->getServiceLocator()->get('viewHelperManager');
        $headTitleHelper   = $viewHelperManager->get('headTitle');

        return $headTitleHelper;
    }

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return AbstractHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get the service locator.
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
