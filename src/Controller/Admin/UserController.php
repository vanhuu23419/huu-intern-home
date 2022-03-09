<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use App\Libs\ConfigUtil;
use App\Model\Table\UsersTable;
use Cake\Routing\Router;
use Cake\Collection\Collection;
use App\Model\Validation\AppValidator;
use App\Libs\CSVExport;

class UserController extends AdminController
{
    /**
     * Render ADMIN_USER_SEARCH screen
     */
    public function index() {
        // set search options
        $searchOptions = [
            'email' => '',
            'name' => '',
            'phone' => '',
            'user_flg' => array_keys($this->fetchTable('Users')->getUserFlags()),
            'page' => 1,
            'perPage' => 10, // record per page
        ];
        foreach($this->request->getQuery() as $key => $val) {
            $searchOptions[$key] = $val;
        }
        if (isset($searchOptions['_csrfToken']) && !isset($this->request->getQuery()['user_flg'])) {
            $searchOptions['user_flg'] = [];
        }

        // validate search options
        $validator = new AppValidator();
        if ($searchOptions['email']) {
            $validator->extend('email', 'email', 'Email');
        }
        if ($searchOptions['phone']) {
            $validator->extend('phone', 'integer', 'Phone');
        }
        $errors = $validator->validate($this->request->getQuery()); 
        if (!empty($errors)) {
            foreach($errors as $key => $err) {
                // remove options with error
                unset($searchOptions[$key]);
                // set flash message
                foreach($err as $rule => $msg) {
                    $this->Flash->error(__($msg));
                    break;
                }
            }
        }

        // table data
        $totalRecords = 0; // totals record matches search condition before pagination
        $tableData = $this->fetchTable('Users')->search($searchOptions, $totalRecords);
        $tableData = $tableData->map(function($user) { 
                                    $user_flg_name = $user->getUserFlagName();
                                    $user = $user->toArray();  // turn each Entity to array
                                    $user['user_flg_name'] = $user_flg_name;
                                    return $user;
                                })
                                ->toArray(); 
        if (count($tableData) == 0) {
            $this->set('emptyError', ConfigUtil::getMessage('E005'));
        }
        
        // table head
        $tableHead = [ 
            'id' => 'ID', 
            'email' => 'Email', 
            'name' => 'Full name',
            'user_flg_name' => 'User flag',
            'phone' => 'Phone',
            'address' => 'Address',
        ];
        $this->set('tableHead', $tableHead);

        // table option
        $this->set('tableData', $tableData);
        $this->set('tableOptions', [
            'renderId' => false  // whether or not render the Id colunn 
        ]);
        $this->set('rowId', 'id');  // primary key of a record
        $this->set('columnWidths', [
            'email' => 15, 
            'name' => 15,
            'user_flg_name' => 15,
            'phone' => 15,
            'address' => 15,
        ]);

        // breadcrumb
        $this->set('breadcrumbsTrail', [
            ['title' => 'Top', 'url' => Router::url(['prefix' => 'Admin', 'controller' => 'Top', 'action' => 'index'], true)],
            ['title' => 'Users', 'url' => Router::url(['prefix' => 'Admin', 'controller' => 'User', 'action' => 'index'], true)],
        ]);

        // page title
        $this->set('pageTitle', 'Users');

        // pagination
        $this->set('pagination', [
            'total' => $totalRecords,
            'page' => $searchOptions['page'],
            'perPage' => $searchOptions['perPage'],
            'paginationOffset' => 4, // maximum paginate button per page
        ]);

        // search toolbar
        $user_flg = $this->fetchTable('Users')->getUserFlags();
        $this->set('userFlags', $user_flg);

        // query
        $this->set('query', $searchOptions);

        return $this->render();
    }

    /**
     * Update User data
     */
    public function edit(int $id) {
        // $id is not provided OR not existed
        // redirect to ADMIN_USER_SEARCH
        $record = $this->fetchTable('Users')->getById($id);
        if (!$id || !$record) {
            return $this->redirect(Router::url(['prefix' => 'Admin', 'controller' => 'User', 'action' => 'index'], true));
        }

        $this->set('record', $record);
        return $this->render();
    }

    /**
     * Soft delete user
     */
    public function delete(int $id) {
        if ($id) {
            $authResult = $this->Authentication->getResult();
            if ($authResult->isValid()) {
                // soft delete user
                $user = $authResult->getData();
                $query = $this->fetchTable('Users')->softDelete($id, $user->id);
                // return response
                $response = $this->response->withType("application/json")->withStringBody(json_encode([
                    'success' => 1,
                ]));
                return $response;
            }
        }
        // failed to delete
        $response = $this->response->withType("application/json")->withStringBody(json_encode([
            'success' => 0,
        ]));
        return $response;
    }

    /**
     * Export CSV for ADMIN_USER_SEARCH
     */
    public function exportCSV() {
        // set search options
        $searchOptions = [
            'email' => '',
            'name' => '',
            'phone' => '',
            'perPage' => false,
            'user_flg' => [],
        ];
        foreach($this->request->getQuery() as $key => $val) {
            $searchOptions[$key] = $val;
        }
        // get users
        $tableData = $this->fetchTable('Users')->search($searchOptions);
        $tableData = $tableData->map(function($user) { 
            $user = $user->toArray();  // turn each Entity to array
            return $user;
        })
        ->toArray(); 
        
        // format user data & build CSV string
        for($i=0, $len = count($tableData); $i < $len; ++$i) {
            $tableData[$i]['user_id'] = $tableData[$i]['id'];
            $tableData[$i]['created_at'] = $tableData[$i]['created_at']->i18nFormat('yyyy/MM/dd');
        }
        $headers = ['user_id','email','name','user_flg','phone','address','del_flg','created_by','created_at'];
        $CSVContent = CSVExport::formatData($tableData, $headers);
        // return download file
        $response = $this->response
                            ->withType('csv')
                            ->withStringBody($CSVContent)
                            ->withDownload('users_'.date('YmdHis', time()).'.csv'); //[Tên bảng]_YYYYMMDDhhmmss.csv
        return $response;
    }
}
