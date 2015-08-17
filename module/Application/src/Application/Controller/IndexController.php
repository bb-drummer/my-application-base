<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\BaseActionController;

class IndexController extends BaseActionController
{
    
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
}
