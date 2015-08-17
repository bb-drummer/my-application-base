<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Admin for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\BaseActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\User;
use Admin\Form\UserForm;

class UsersController extends BaseActionController
{
	protected $userTable;

	public function indexAction()
    {
        return new ViewModel(array(
            'userdata' => $this->getUSerTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $tmplVars = array_merge( 
			$this->params()->fromRoute(), 
			$this->params()->fromPost(),
			array()
		);
        //if (!class_exists('\Admin\Form\UserForm')) { require_once __DIR__ . '/../Form/UserForm.php'; }
        $form = new UserForm();
        $form->get('submit')->setValue('Benutzer anlegen');

        $request = $this->getRequest();
        $user = new User();
        if ($request->isPost()) {
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);
                // Redirect to list of users
        		$this->flashMessenger()->addSuccessMessage("Benutzer wurde angelegt.");
                return $this->redirect()->toRoute('admin/default', array('controller' => 'users'));
            }
	        $tmplVars["user"] = $user;
        }
        $tmplVars["form"] = $form;
        return new ViewModel($tmplVars);
    }

    public function editAction()
    {
		$tmplVars = array_merge( 
			$this->params()->fromRoute(), 
			$this->params()->fromPost(),
			array()
		);
        $id = (int) $this->params()->fromRoute('user_id', 0);
        if (!$id) {
        	$this->flashMessenger()->addWarningMessage("Fehlende Parameter");
            return $this->redirect()->toRoute('admin/default', array(
            	'controller' => 'users',
                'action' => 'add'
            ));
        }
        $user = $this->getUserTable()->getUser($id);

        $form  = new UserForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'speichern');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getUserTable()->saveUser($user);

                // Redirect to list of users
        		$this->flashMessenger()->addSuccessMessage("Benutzer wurde gespeichert.");
                return $this->redirect()->toRoute('admin/default', array('controller' => 'users', 'action' => 'index'));
            }
        } else {
       		$form->bind($user); //->getArrayCopy());
        }
        $tmplVars["user_id"] = $id;
        $tmplVars["form"] = $form;
        return new ViewModel($tmplVars);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('user_id', 0);
        if (!$id) {
        	$this->flashMessenger()->addWarningMessage("Fehlende Parameter");
            return $this->redirect()->toRoute('admin/default', array('controller' => 'users', 'action' => 'index'));
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', '');

            if (!empty($del)) {
                $id = (int) $request->getPost('id');
                $this->getUserTable()->deleteUser($id);
        		$this->flashMessenger()->addSuccessMessage("Benutzer wurde entfernt.");
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('admin/default', array('controller' => 'users', 'action' => 'index'));
        }

        $tmplVars["user_id"] = $id;
        $tmplVars["user"] = $this->getUserTable()->getUser($id);
        return new ViewModel($tmplVars);
    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Admin\Model\UserTable');
        }
        return $this->userTable;
    }
}
