<?php
/**
 * BB's Zend Framework 2 Components
 * 
 * BaseApp
 *
 * @package		[MyApplication]
 * @package		BB's Zend Framework 2 Components
 * @package		BaseApp
 * @author		Björn Bartels [dragon-projects.net] <info@dragon-projects.net>
 * @link		http://gitlab.dragon-projects.de:81/groups/zf2
 * @license		http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @copyright	copyright (c) 2016 Björn Bartels [dragon-projects.net] <info@dragon-projects.net>
 */

namespace Application\Controller;

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
	
	public function testAction()
	{
		return new ViewModel();
	}
	
	public function xhrtestAction()
	{
		return new ViewModel();
	}

	/**
	 * render view in json examples
	 * @link	http://stackoverflow.com/questions/12451399/how-to-render-zf2-view-within-json-response
	 */
	public function example_1_Action()
	{
		if (!$this->getRequest()->isXmlHttpRequest()) {
		return array();
		}
	
		$htmlViewPart = new ViewModel();
		$htmlViewPart->setTerminal(true)
			->setTemplate('module/controller/action')
			->setVariables(array(
				'key' => 'value'
			));
	
		$htmlOutput = $this->getServiceLocator()
			 ->get('viewrenderer')
			 ->render($htmlViewPart);
	
		$jsonModel = new JsonModel();
		$jsonModel->setVariables(array(
			'html' => $htmlOutput,
			'jsonVar1' => 'jsonVal2',
			'jsonArray' => array(1,2,3,4,5,6)
		));
	
		return $jsonModel;
	}

	public function render_view_in_json2Action() {
		$partial = $this->getServiceLocator()->get('viewhelpermanager')->get('partial');
		$data = array(
			'html' => $partial('MyModule/MyPartView.phtml', array("key" => "value")),
			'jsonVar1' => 'jsonVal2',
			'jsonArray' => array(1, 2, 3, 4, 5, 6)
		);
		$isAjax = $this->getRequest()->isXmlHttpRequest();
		return isAjax?new JsonModel($data):new ViewModel($data);
	}
}
