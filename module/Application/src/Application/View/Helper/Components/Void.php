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
class Void extends AbstractHelper implements 
	\Zend\ServiceManager\ServiceLocatorAwareInterface
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
    	if ( is_object($options) && method_exists($options, 'toArray') ) {
    		$options = $options->toArray();
    	} else if ( is_object($options) ) {
    		$options = (array)$options;
    	}
    	
        if (isset($options['container']) && (null !== $options['container'])) {
            $this->setContainer($options['container']);
        }
    
        if (isset($options['tagname']) && (null !== $options['tagname'])) {
        	$this->setTagname($options['tagname']);
        }
        if (isset($options['class']) && (null !== $options['class'])) {
        	$this->setClassnames($options['class']);
        }
        if (isset($options['classnames']) && (null !== $options['classnames'])) {
        	$this->setClassnames($options['classnames']);
        }

        if (isset($options['attr']) && (null !== $options['attr'])) {
        	$this->setAttributes($options['attr']);
        }
        if (isset($options['attributes']) && (null !== $options['attributes'])) {
        	$this->setAttributes($options['attributes']);
        }

        if (isset($options['content']) && (null !== $options['content'])) {
        	$this->setContent($options['content']);
        }
        if (isset($options['children']) && (null !== $options['children'])) {
        	$this->setContent($options['children']);
        }
        
        $component = clone $this;
        return $component;
    }
	
	/**
	 * render component
	 * 
	 * @param boolean $output
	 * 
	 * @return string
	 */
	public function render($output = false)
	{	
		try {
        	
			if ($output) {
				echo $this->buildComponent();
			}
			return $this->buildComponent();
			
		} catch (\Exception $e) {
        	
			$msg = get_class($e) . ': ' . $e->getMessage() . "\n" . $e->getTraceAsString();
			trigger_error($msg, E_USER_ERROR);
			return '';
            
		}
	}

}