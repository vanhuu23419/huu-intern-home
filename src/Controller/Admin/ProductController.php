<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use App\Libs\ConfigUtil;
use App\Model\Table\UsersTable;
use Cake\Routing\Router;

class ProductController extends AdminController
{
    /**
     * Render ADMIN_PRODUCT_SEARCH screen
     */
    public function index() {

        // use this to render breadcrumbs trail with BreadcrumbsHelper
        $this->set('breadcrumbsTrail', [
            ['title' => 'Top', 'url' => Router::url(['prefix' => 'Admin', 'controller' => 'Top', 'action' => 'index'], true)],
            ['title' => 'Products', 'url' => Router::url(['prefix' => 'Admin', 'controller' => 'Product', 'action' => 'index'], true)],
        ]);

        return $this->render();
    }

    /**
     * Update product data 
     */
    public function edit(int $id) {
        // User id is not provided or not exist
        // redirect to ADMIN_PRODUCT_SEARCH
        $check = false; // temporary for unit testing
        if (!$id || !$check) {
            return $this->redirect(Router::url(['prefix' => 'Admin', 'controller' => 'Top', 'action' => 'index'], true));
        }
    }
}
