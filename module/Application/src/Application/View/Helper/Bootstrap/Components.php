<?php
/**
 * [MyApplication] (http://gitlab.dragon-projects.net:81/zf2/application-base)
 *
 * @link      http://gitlab.dragon-projects.net:81/zf2/application-base for the canonical source repository
 * @copyright Copyright (c) 2015 [dragon-projects.net] (http://dragon-projects.net)
 * @license   GPL
 */

namespace Application\View\Helper\Bootstrap;

/**
 *
 * Helper to get Components colletion opject/view helper plugin
 * 
 */
class Components extends \Application\View\Helper\Navigation\Menu
{

    /**
     * View helper entry point:
     * Retrieves helper and optionally sets container to operate on
     *
     * @param  AbstractContainer $container [optional] container to operate on
     * @return self
     */
    public function __invoke($options = array())
    {
        return $this->view->components($options);
    }

	
}