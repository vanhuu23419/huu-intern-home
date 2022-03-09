<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use App\Libs\ConfigUtil;
use App\Model\Table\UsersTable;
use Cake\Routing\Router;


class AdminController extends AppController
{
    /**
     * beforeFilter hook
     */
    public function beforeFilter(EventInterface $event) {

        parent::beforeFilter($event);
        
        $this->Authorization->skipAuthorization();
    }

    public function initialize(): void {
        parent::initialize();
        
        /**
         * Set common data for screens
         */
        
        // routes
        $this->set('currentRoute', Router::url(null, true));
        $this->set('topRoute', Router::url(['prefix' => 'Admin', 'controller' => 'Top', 'action' => 'index'], true));

        // labels & urls for Admin screens 
        $this->pagesName = [
            'Users' => Router::url([
                'prefix' => 'Admin',
                'controller' => 'User',
                'action' => 'index',
            ], true), // ADMIN_USER_SEARCH
            'Categories' => Router::url([
                'prefix' => 'Admin',
                'controller' => 'Category',
                'action' => 'index',
            ], true), // ADMIN_CATEGORY_SEARCH
            'Products' => Router::url([
                'prefix' => 'Admin',
                'controller' => 'Product',
                'action' => 'index',
            ], true), // ADMIN_PRODUCT_SEARCH
        ];
        $this->set('pagesName', $this->pagesName);

        // authenticated user
        $authResult = $this->Authentication->getResult(); 
        if ($authResult->isValid()) {
            $user = $authResult->getData();
            $this->set('user', $user);
            /* Set layout */
            $this->viewBuilder()->setLayout('admin/admin');
        }
    }
}
