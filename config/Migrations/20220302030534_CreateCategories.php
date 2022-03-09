<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCategories extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        // Create Categories table
        $categories = $this->table('categories', [
            'id' => false, 
            'primary_key' => ['id'],
        ]);
        $categories->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
            ])
            ->addColumn('name', 'string', [
                'limit' => 100,
            ])
            ->addColumn('alias', 'string', [
                'null' => true,
                'limit' => 100,
                'comment' => 'use for friendly URL',
            ])
            ->addColumn('sort_order', 'smallinteger', [
                'default' => 0, 
                'comment' => 'position on menu',
            ]);
        $categories->addColumn('del_flg', 'smallinteger', [
                'default' => 0, 
                'comment' => '0:no;1:yes',
            ])
            ->addColumn('created_by', 'biginteger', [
                'null' => true, 
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => true, 
            ])
            ->addColumn('updated_by', 'biginteger', [
                'null' => true, 
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true, 
            ])
            ->addColumn('deleted_by', 'biginteger', [
                'null' => true, 
            ])
            ->addColumn('deleted_at', 'datetime', [
                'null' => true, 
            ])
            ->addForeignKey('created_by', 'users', 'id')
            ->addForeignKey('updated_by', 'users', 'id')
            ->addForeignKey('deleted_by', 'users', 'id');
        $categories->create();
    }
}
