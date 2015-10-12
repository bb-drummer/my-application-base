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
class Void extends AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{

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
	 * render nothing
	 * 
	 * @return string
	 */
	public function render($container = null)
	{
		$html = ''.__CLASS__.'';
		
		return $html;
	}

}