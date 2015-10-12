<?php
/**
 * [MyApplication] (http://gitlab.dragon-projects.net:81/zf2/application-base)
 *
 * @link      http://gitlab.dragon-projects.net:81/zf2/application-base for the canonical source repository
 * @copyright Copyright (c) 2015 [dragon-projects.net] (http://dragon-projects.net)
 * @license   GPL
 */

namespace Application\View\Helper\Components;

/**
 *
 * render nothing
 *
 */
class Toolbar extends AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
	
	/**
	 * header content string/value(s)
	 *
	 * @var mixed
	 */
	protected $header = '';
	
	/**
	 * content string/value(s)
	 *
	 * @var mixed
	 */
	protected $content = '';
	
	/**
	 * content string/value(s)
	 *
	 * @var mixed
	 */
	protected $footer = '';
	
	/**
	 * wrapper's tag-name
	 *
	 * @var string
	 */
	protected $componentTagname = 'div';
	
	/**
	 * header's tag-name
	 *
	 * @var string
	 */
	protected $headerTagname = '';
	
	/**
	 * content's tag-name
	 *
	 * @var string
	 */
	protected $contentTagname = '';
	
	/**
	 * footer's tag-name
	 *
	 * @var string
	 */
	protected $footerTagname = '';
	
	/**
	 * component's class names
	 *
	 * @var string
	 */
	protected $componentClass = 'toolbar toolbar-nav';
	
	/**
	 * header's class-name
	 *
	 * @var string
	 */
	protected $headerClass = '';
	
	/**
	 * content's class names
	 *
	 * @var string
	 */
	protected $contentClass = '';
	
	/**
	 * footer's class names
	 *
	 * @var string
	 */
	protected $footerClass = '';
	

    /**
     * View helper entry point:
     * Retrieves helper and optionally sets component options to operate on
     *
     * @param  array|StdClass $options [optional] component options to operate on
     * @return self
     */
    public function __invoke($options = array())
    {
        if (isset($options['container']) && null !== $options['container']) {
            $this->setContainer($options['container']);
        }

        return $this;
    }
	
	/**
	 * render component
	 * 
	 * @return string
	 */
	public function render($content = null)
	{
		$html = ''.__CLASS__.'';
		
		return $html;
	}
	
	/**
	 * @return the $header
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * @param mixed $header
	 */
	public function setHeader($header) {
		$this->header = $header;
		return $this;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}

	/**
	 * @return the $footer
	 */
	public function getFooter() {
		return $this->footer;
	}

	/**
	 * @param mixed $footer
	 */
	public function setFooter($footer) {
		$this->footer = $footer;
		return $this;
	}

	/**
	 * @return the $componentTagname
	 */
	public function getComponentTagname() {
		return $this->componentTagname;
	}

	/**
	 * @param string $componentTagname
	 */
	public function setComponentTagname($componentTagname) {
		$this->componentTagname = $componentTagname;
		return $this;
	}

	/**
	 * @return the $headerTagname
	 */
	public function getHeaderTagname() {
		return $this->headerTagname;
	}

	/**
	 * @param string $headerTagname
	 */
	public function setHeaderTagname($headerTagname) {
		$this->headerTagname = $headerTagname;
		return $this;
	}

	/**
	 * @return the $contentTagname
	 */
	public function getContentTagname() {
		return $this->contentTagname;
	}

	/**
	 * @param string $contentTagname
	 */
	public function setContentTagname($contentTagname) {
		$this->contentTagname = $contentTagname;
		return $this;
	}

	/**
	 * @return the $footerTagname
	 */
	public function getFooterTagname() {
		return $this->footerTagname;
	}

	/**
	 * @param string $footerTagname
	 */
	public function setFooterTagname($footerTagname) {
		$this->footerTagname = $footerTagname;
		return $this;
	}

	/**
	 * @return the $componentClass
	 */
	public function getComponentClass() {
		return $this->componentClass;
	}

	/**
	 * @param string $componentClass
	 */
	public function setComponentClass($componentClass) {
		$this->componentClass = $componentClass;
		return $this;
	}

	/**
	 * @return the $headerClass
	 */
	public function getHeaderClass() {
		return $this->headerClass;
	}

	/**
	 * @param string $headerClass
	 */
	public function setHeaderClass($headerClass) {
		$this->headerClass = $headerClass;
		return $this;
	}

	/**
	 * @return the $contentClass
	 */
	public function getContentClass() {
		return $this->contentClass;
	}

	/**
	 * @param string $contentClass
	 */
	public function setContentClass($contentClass) {
		$this->contentClass = $contentClass;
		return $this;
	}

	/**
	 * @return the $footerClass
	 */
	public function getFooterClass() {
		return $this->footerClass;
	}

	/**
	 * @param string $footerClass
	 */
	public function setFooterClass($footerClass) {
		$this->footerClass = $footerClass;
		return $this;
	}



}