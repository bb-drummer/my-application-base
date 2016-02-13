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

use Zend\View\Model\ViewModel;
use Application\Controller\BaseActionController;

class SystemController extends BaseActionController
{
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $this->setActionTitles(
            array(
            'index' => $this->translate("system"),
            'info' => $this->translate("info"),
            'backup' => $this->translate("backup"),
            )
        );
        return parent::onDispatch($e);
    }
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function infoAction()
    {
        return new ViewModel();
    }
    
    public function backupAction()
    {
        return new ViewModel();
    }
}
