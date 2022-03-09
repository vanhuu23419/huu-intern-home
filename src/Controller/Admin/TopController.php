<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use App\Libs\ConfigUtil;
use App\Model\Table\UsersTable;
use Cake\Routing\Router;


class TopController extends AdminController
{
    /**
     * Render ADMIN_TOP screen
     */
    public function index() {

        // use this to render breadcrumbs trail with BreadcrumbsHelper
        $this->set('breadcrumbsTrail', [
            ['title' => 'Top', 'url' => Router::url(['prefix' => 'Admin', 'controller' => 'Top', 'action' => 'index'], true)],
        ]);

        //page title
        $this->set('pageTitle', 'Top');

        return $this->render();
    }
}
