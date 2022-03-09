<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProducts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        // Create Product table
        $products = $this->table('products', [
            'id' => false, 
            'primary_key' => ['id'],
        ]);
        $products->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
            ])
            ->addColumn('category_id', 'biginteger')
            ->addColumn('name', 'string', [
                'limit' => 100,
            ])
            ->addColumn('alias', 'string', [
                'null' => true, 
                'limit' => 100, 
                'comment' => 'use for friendly URL',
            ])
            ->addColumn('price', 'decimal', [ 
                'precision'=> 15, 
                'scale' => 4, 
                'default' => 0,
            ])
            ->addColumn('content', 'text')
            ->addColumn('image_link', 'string', [
                'null' => true, 
                'limit' => 50,
            ])
            ->addColumn('viewed', 'integer', [
                'null' => true, 
                'default' => 0,
            ])
            ->addColumn('ordered', 'integer', [
                'null' => true, 
                'default' => 0,
            ])
            ->addColumn('featured_flg', 'smallinteger', [
                'default' => 0, 
                'comment' => '0:no;1:yes',
            ])
            ->addForeignKey('category_id', 'categories', 'id');
            
        $products->addColumn('del_flg', 'smallinteger', [
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
        $products->create();
    }
}
