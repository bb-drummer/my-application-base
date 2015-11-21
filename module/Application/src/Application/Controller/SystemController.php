<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BaseActionController;

class SystemController extends BaseActionController
{
    
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
