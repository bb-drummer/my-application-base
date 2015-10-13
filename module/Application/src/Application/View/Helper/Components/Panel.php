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
class Panel extends Void
{
	protected $tagname = 'div';
	
	protected $classnames = 'panel panel-default';
	
	/**
     * View helper entry point:
     * Retrieves helper and optionally sets component options to operate on
     *
     * @param  array|StdClass $options [optional] component options to operate on
     * @return self
     */
    public function __invoke($options = array())
    {
        parent::__invoke($options);
        return $this;
    }
	
}