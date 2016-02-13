<?php
/**
 * BB's Zend Framework 2 Components
 * 
 * BaseApp
 *
 * @package   [MyApplication]
 * @package   BB's Zend Framework 2 Components
 * @package   BaseApp
 * @author    Björn Bartels [dragon-projects.net] <info@dragon-projects.net>
 * @link      http://gitlab.dragon-projects.de:81/groups/zf2
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @copyright copyright (c) 2016 Björn Bartels [dragon-projects.net] <info@dragon-projects.net>
 */

namespace Application\Controller;

//use Zend\Json\Json;
//use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Application\Controller\BaseActionController;

class IndexController extends BaseActionController
{
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $this->setActionTitles(
            array(
            'index' => $this->translate("home"),
            'help' => $this->translate("help"),
            'support' => $this->translate("support"),
            'about' => $this->translate("about"),
            'test' => $this->translate("test page"),
            'xhrtest' => $this->translate("xhr test action"),
            )
        );
        return parent::onDispatch($e);
    }
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function helpAction()
    {
        return new ViewModel();
    }
    
    public function supportAction()
    {
        return new ViewModel();
    }
    
    public function aboutAction()
    {
        return new ViewModel();
    }
    
    public function testAction()
    {
        return new ViewModel();
    }
    
    public function xhrtestAction()
    {
        return new ViewModel();
    }

}
