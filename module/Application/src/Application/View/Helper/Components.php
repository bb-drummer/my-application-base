<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Exception;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\Mvc\Application;

/**
 * Proxy helper for retrieving navigational helpers and forwarding calls
 */
class Components extends Bootstrap\AbstractHelper
{
    /**
     * View helper namespace
     *
     * @var string
     */
    const NS = 'Application\View\Helper\Bootstrap';

    /**
     * Default proxy to use in {@link render()}
     *
     * @var string
     */
    protected $defaultProxy = 'void';

    /**
     * Indicates whether or not a given helper has been injected
     *
     * @var array
     */
    protected $injected = [];

    /**
     * Whether ACL should be injected when proxying
     *
     * @var bool
     */
    protected $injectAcl = true;

    /**
     * Whether container should be injected when proxying
     *
     * @var bool
     */
    protected $injectContainer = true;

    /**
     * Whether translator should be injected when proxying
     *
     * @var bool
     */
    protected $injectTranslator = true;

    /**
     * @var Navigation\PluginManager
     */
    protected $plugins;

    /**
     * Helper entry point
     *
     * @param  string|AbstractContainer $container container to operate on
     * @return Navigation
     */
    public function __invoke($options = array())
    {
        if (isset($options['container']) && null !== $options['container']) {
            $this->setContainer($options['container']);
        }

        return $this;
    }

    /**
     * Magic overload: Proxy to other navigation helpers or the container
     *
     * Examples of usage from a view script or layout:
     * <code>
     * // proxy to Menu helper and render container:
     * echo $this->bootstrap()->menu();
     *
     * // proxy to Breadcrumbs helper and set indentation:
     * $this->bootstrap()->breadcrumbs()->setIndent(8);
     *
     * </code>
     *
     * @param  string $method             helper name or method name in container
     * @param  array  $arguments          [optional] arguments to pass
     * @throws \Zend\View\Exception\ExceptionInterface        if proxying to a helper, and the
     *                                    helper is not an instance of the
     *                                    interface specified in
     *                                    {@link findHelper()}
     * @throws \Zend\View\Exception\ExceptionInterface  if method does not exist in container
     * @return mixed                      returns what the proxied call returns
     */
    public function __call($method, array $arguments = [])
    {
        // check if call should proxy to another helper
        $helper = $this->findHelper($method, false);
        if ($helper) {
            if ($helper instanceof ServiceLocatorAwareInterface && $this->getServiceLocator()) {
                $helper->setServiceLocator($this->getServiceLocator());
            }
            return call_user_func_array($helper, $arguments);
        }

        // default behaviour: proxy call to container
        return parent::__call($method, $arguments);
    }

    /**
     * Renders helper
     *
     * @param  AbstractContainer $container
     * @return string
     * @throws Exception\RuntimeException
     */
    public function render($container = null)
    {
        return $this->findHelper($this->getDefaultProxy())->render($container);
    }

    /**
     * Returns the helper matching $proxy
     *
     * The helper must implement the interface
     * {@link Application\View\Helper\Bootstrap\Helper}.
     *
     * @param string $proxy  helper name
     * @param bool   $strict [optional] whether exceptions should be
     *                                  thrown if something goes
     *                                  wrong. Default is true.
     * @throws Exception\RuntimeException if $strict is true and helper cannot be found
     * @return \Application\\View\Helper\Bootstrap\HelperInterface  helper instance
     */
    public function findHelper($proxy, $strict = true)
    {
        $plugins = $this->getPluginManager();
        if (!$plugins->has($proxy)) {
            if ($strict) {
                throw new Exception\RuntimeException(sprintf(
                    'Failed to find plugin for %s',
                    $proxy
                ));
            }
            return false;
        }

        $helper    = $plugins->get($proxy);
        $container = $this->getContainer();
        $hash      = spl_object_hash($container) . spl_object_hash($helper);

        if (!isset($this->injected[$hash])) {
            $helper->setContainer();
            $this->inject($helper);
            $this->injected[$hash] = true;
        } else {
            if ($this->getInjectContainer()) {
                $helper->setContainer($container);
            }
        }

        return $helper;
    }

    /**
     * Injects container, ACL, and translator to the given $helper if this
     * helper is configured to do so
     *
     * @param  \Zend\View\Helper\AbstractHelper $helper helper instance
     * @return void
     */
    protected function inject(\Zend\View\Helper\AbstractHelper $helper)
    {
        if ($this->getInjectContainer() && !$helper->hasContainer()) {
            $helper->setContainer($this->getContainer());
        }

        if ($this->getInjectAcl()) {
            if (!$helper->hasAcl()) {
                $helper->setAcl($this->getAcl());
            }
            if (!$helper->hasRole()) {
                $helper->setRole($this->getRole());
            }
        }

        if ($this->getInjectTranslator() && !$helper->hasTranslator()) {
            $helper->setTranslator(
                $this->getTranslator(),
                $this->getTranslatorTextDomain()
            );
        }
    }

    /**
     * Sets the default proxy to use in {@link render()}
     *
     * @param  string $proxy default proxy
     * @return Bootstrap
     */
    public function setDefaultProxy($proxy)
    {
        $this->defaultProxy = (string) $proxy;
        return $this;
    }

    /**
     * Returns the default proxy to use in {@link render()}
     *
     * @return string
     */
    public function getDefaultProxy()
    {
        return $this->defaultProxy;
    }

    /**
     * Sets whether container should be injected when proxying
     *
     * @param  bool $injectContainer
     * @return Bootstrap
     */
    public function setInjectContainer($injectContainer = true)
    {
        $this->injectContainer = (bool) $injectContainer;
        return $this;
    }

    /**
     * Returns whether container should be injected when proxying
     *
     * @return bool
     */
    public function getInjectContainer()
    {
        return $this->injectContainer;
    }

    /**
     * Sets whether ACL should be injected when proxying
     *
     * @param  bool $injectAcl
     * @return NavigBootstrapation
     */
    public function setInjectAcl($injectAcl = true)
    {
        $this->injectAcl = (bool) $injectAcl;
        return $this;
    }

    /**
     * Returns whether ACL should be injected when proxying
     *
     * @return bool
     */
    public function getInjectAcl()
    {
        return $this->injectAcl;
    }

    /**
     * Sets whether translator should be injected when proxying
     *
     * @param  bool $injectTranslator
     * @return Bootstrap
     */
    public function setInjectTranslator($injectTranslator = true)
    {
        $this->injectTranslator = (bool) $injectTranslator;
        return $this;
    }

    /**
     * Returns whether translator should be injected when proxying
     *
     * @return bool
     */
    public function getInjectTranslator()
    {
        return $this->injectTranslator;
    }

    /**
     * Set manager for retrieving navigation helpers
     *
     * @param  Bootstrap\PluginManager $plugins
     * @return Bootstrap
     */
    public function setPluginManager(Bootstrap\PluginManager $plugins)
    {
        $renderer = $this->getView();
        if ($renderer) {
            $plugins->setRenderer($renderer);
        }
        $this->plugins = $plugins;

        return $this;
    }

    /**
     * Retrieve plugin loader for navigation helpers
     *
     * Lazy-loads an instance of Navigation\HelperLoader if none currently
     * registered.
     *
     * @return Bootstrap\PluginManager
     */
    public function getPluginManager()
    {
        if (null === $this->plugins) {
            $this->setPluginManager(new Bootstrap\PluginManager());
        }

        return $this->plugins;
    }

    /**
     * Set the View object
     *
     * @param  Renderer $view
     * @return self
     */
    public function setView(Renderer $view)
    {
        parent::setView($view);
        if ($view && $this->plugins) {
            $this->plugins->setRenderer($view);
        }
        return $this;
    }
}
