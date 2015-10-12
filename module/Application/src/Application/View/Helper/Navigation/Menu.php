<?php
/**
 * [MyApplication] (http://gitlab.dragon-projects.net:81/zf2/application-base)
 *
 * @link      http://gitlab.dragon-projects.net:81/zf2/application-base for the canonical source repository
 * @copyright Copyright (c) 2015 [dragon-projects.net] (http://dragon-projects.net)
 * @license   GPL
 */

namespace Application\View\Helper\Navigation;

/**
 *
 * Helper for recursively rendering 'Bootstrap' compatible multi-level menus
 *
 */
class Menu extends \Zend\View\Helper\Navigation\Menu implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{

    /**
     * default CSS class to use for li elements
     *
     * @var string
     */
    protected $defaultLiClass = '';

	/**
     * CSS class to use for the ul sub-menu element
     *
     * @var string
     */
    protected $subUlClass = 'dropdown-menu';

    /**
     * CSS class to use for the 1. level (NOT root level!) ul sub-menu element
     *
     * @var string
     */
    protected $subUlClassLevel1 = 'dropdown-menu';

	/**
     * CSS class to use for the active li sub-menu element
     *
     * @var string
     */
    protected $subLiClass = 'dropdown-submenu';

    /**
     * CSS class to use for the active li sub-menu element
     *
     * @var string
     */
    protected $subLiClassLevel0 = 'dropdown';

    /**
     * CSS class prefix to use for the menu element's icon class
     *
     * @var string
     */
    protected $iconPrefixClass = 'icon-';

    /**
     * HREF string to use for the sub-menu toggle element's HREF attribute, 
     * to override current page's href/'htmlify' setting
     *
     * @var string
     */
    protected $hrefSubToggleOverride = null;

    /**
     * View helper entry point:
     * Retrieves helper and optionally sets container to operate on
     *
     * @param  AbstractContainer $container [optional] container to operate on
     * @return self
     */
    public function __invoke($container = null)
    {
        if (null !== $container) {
            $this->setContainer($container);
        }

        return $this;
    }

    /**
	 * recursively create Bootstrap compatible multi-level UL navigation
	 * 
	 * @param \Zend\Navigation\Page $container
	 * @param \Zend\Navigation\Navigation $navigation
	 * @param number $level
	 * @param number $maxlevel
	 * 
	 * @return string
	 * 
	 * @TODO: WATCH BEHAVIOUR! maybe, we have to add 'renderNormalMenu' and 'renderDeepestMenu' as well :/
	 */
	public function render($container = null, $level = 0)
	{
		/* @var $escaper \Zend\View\Helper\EscapeHtmlAttr */
		$escaper = $this->view->plugin('escapeHtmlAttr');
		/* @var $navigation \Zend\View\Helper\Navigation */
		$navigation = $this->view->navigation(); // ; // ->view->plugin('navigation'); // ->view->navigation(); //
		/* @var $maxlevel number */
		$maxlevel = $this->getMaxDepth();
		/* @var $isBelowMaxLevel boolean */
		$isBelowMaxLevel = ($maxlevel > $level) || ($maxlevel === null) || ($maxlevel === false);
	
		if (null === $container) {
			$container = $this->getContainer();
		}
	
		/* @var $html string the menu html string */
		$html = '<ul class="' . ($level == 0 ? $this->getUlClass() : ($level == 1 ? $this->getSubUlClassLevel1() : $this->getSubUlClass())) . ' level_' . $level . '">' . PHP_EOL;
		foreach ($container as $page):
		if ($navigation->accept($page)):
		$classnames = array();
	
		if (!empty($this->getDefaultLiClass())) {
			$classnames[] = $this->getDefaultLiClass();
		}
		if (!empty($page->pages) && $isBelowMaxLevel) {
			$classnames[] = ($level == 0 ? $this->getSubLiClassLevel0() : $this->getSubLiClass());
		}
		if ($page->isActive(true)) {
			$classnames[] = $this->getLiActiveClass();
		}
	
		$html .= '<li class="'.(implode(" ", $classnames)).'">' . PHP_EOL;
		if (!empty($page->pages) && $isBelowMaxLevel) {
			$href = (
					!empty($this->getHrefSubToggleOverride()) ?
					$this->getHrefSubToggleOverride() : $page->getHref()
					);
			$html .= '<a class="dropdown-toggle" data-toggle="' . ($level == 0 ? $this->getSubLiClassLevel0() : $this->getSubLiClass()) . '" href="' . $href . '">' . PHP_EOL .
			($page->get('icon') ? '<span class="' . $this->getIconPrefixClass() . '' . $page->get('icon') . '"></span> ' : '' ) . PHP_EOL .
			$page->getLabel() .
			'</a>' . PHP_EOL;
		} else {
			$html .= '<a href="' . $page->getHref() . '">' . PHP_EOL .
			($page->get('icon') ? '<span class="' . $this->getIconPrefixClass() . '' . $page->get('icon') . '"></span> ' : '' ) . PHP_EOL .
			$page->getLabel().
			'</a>' . PHP_EOL;
		}
		if (!empty($page->pages)):
		// ... ;
		if ( $isBelowMaxLevel ) {
			$html .= $this->render( $page->pages, $level+1 );
		}
		endif;
	
		$html .= '</li>' . PHP_EOL;
		endif;
		endforeach;
		$html .= '</ul>' . PHP_EOL;
	
		return $html;
	
		//return 'this is my menu (render)';
	}
	
	/**
	 * @return the $defaultLiClass
	 */
	public function getDefaultLiClass() {
		return $this->defaultLiClass;
	}

	/**
	 * @param string $defaultLiClass
	 */
	public function setDefaultLiClass($defaultLiClass) {
		$this->defaultLiClass = $defaultLiClass;
		return $this;
	}

	/**
	 * @return the $subUlClass
	 */
	public function getSubUlClass() {
		return $this->subUlClass;
	}

	/**
	 * @param string $subUlClass
	 */
	public function setSubUlClass($subUlClass) {
		$this->subUlClass = $subUlClass;
		return $this;
	}

	/**
	 * @return the $subUlClassLevel1
	 */
	public function getSubUlClassLevel1() {
		return $this->subUlClassLevel1;
	}

	/**
	 * @param string $subUlClassLevel1
	 */
	public function setSubUlClassLevel1($subUlClassLevel1) {
		$this->subUlClassLevel1 = $subUlClassLevel1;
		return $this;
	}

	/**
	 * @return the $subLiClass
	 */
	public function getSubLiClass() {
		return $this->subLiClass;
	}

	/**
	 * @param string $subLiClass
	 */
	public function setSubLiClass($subLiClass) {
		$this->subLiClass = $subLiClass;
		return $this;
	}

	/**
	 * @return the $subLiClassLevel0
	 */
	public function getSubLiClassLevel0() {
		return $this->subLiClassLevel0;
	}
	
	/**
	 * @param string $subLiClassLevel0
	 */
	public function setSubLiClassLevel0($subLiClassLevel0) {
		$this->subLiClassLevel0 = $subLiClassLevel0;
		return $this;
	}
	
	/**
	 * @return the $iconPrefixClass
	 */
	public function getIconPrefixClass() {
		return $this->iconPrefixClass;
	}

	/**
	 * @param string $iconPrefixClass
	 */
	public function setIconPrefixClass($iconPrefixClass) {
		$this->iconPrefixClass = $iconPrefixClass;
		return $this;
	}
	
	/**
	 * @return the $hrefSubToggleOverride
	 */
	public function getHrefSubToggleOverride() {
		return $this->hrefSubToggleOverride;
	}

	/**
	 * @param string $hrefSubToggleOverride
	 */
	public function setHrefSubToggleOverride($hrefSubToggleOverride) {
		$this->hrefSubToggleOverride = $hrefSubToggleOverride;
		return $this;
	}


	
	
}