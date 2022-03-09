<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use App\Libs\ConfigUtil;
use App\Model\AppValidation;
use App\Model\Table\UsersTable;
use Cake\Validation\Validator;
use Cake\Validation\Validation;
use Cake\Routing\Router;

use App\Model\Validation\AppValidator;

class LoginController extends AppController
{
    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
        $this->Authorization->skipAuthorization();

        $this->Users = $this->fetchTable('Users');
    }

    /**
     * Render ADMIN_LOGIN screen
     */
    public function login() {
        
        $result = $this->Authentication->getResult();

        // Login sucessful, redirect to '/admin'
        if ($result->isValid()) {
            // Check User's Data
            $user = $result->getData();
            if (!$user->isDeleted() && $user->isAdmin()) {
                $loginUrl = Router::url(['prefix' => 'Admin', 'controller' => 'Top', 'action' => 'index'], true);
                return $this->redirect($loginUrl);
            }
            else {
                $errMsg = ConfigUtil::getMessage('E010');
                $this->Flash->error(__($errMsg));
                // Clear login session  
                $this->Authentication->logout();
            }
        }
        // Login failed, display error
        else if ($this->request->is('post')) {
            // Error message for: validations
            $validator = new AppValidator();
            $validator->extend('email', 'email', 'Email');
            $validator->extend('email', 'required', 'Email');
            $validator->extend('password', 'required', 'Password');
            $errors = $validator->validate($this->request->getData()); 
            $errMsg = '';
            if (!empty($errors)) {
                foreach($errors as $key => $err) {
                    foreach($err as $rule => $msg) {
                        $this->Flash->error(__($msg));
                        break;
                    }
                }
            }
            // Error message for: email or password not match
            else {
                $errMsg = ConfigUtil::getMessage('E010');
            }
            $this->Flash->error(__($errMsg));
        }

        return $this->render();
    }

    /**
     * Logout & redirect to ADMIN_LOGIN
     */
    public function logout() {
        // Clear login session
        if ($this->Authentication->getResult()->isValid()) {  
            $this->Authentication->logout();
        }
        $loginUrl = Router::url(['prefix' => 'Admin', 'controller' => 'Login', 'action' => 'login'], true);
        return $this->redirect($loginUrl);
    }
}
