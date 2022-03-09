<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateOrders extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        // Create Orders table
        $orders = $this->table('orders', [
                'id' => false, 
                'primary_key' => ['id'],
            ])
            ->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
            ])
            ->addColumn('transaction_id', 'biginteger')
            ->addColumn('product_id', 'biginteger')
            ->addColumn('qty', 'integer', [
                'default' => 0,
            ])
            ->addColumn('amount', 'decimal', [
                'default' => 0, 
                'precision' => 15, 
                'scale' => 4,
            ])
            ->addForeignKey('transaction_id', 'transactions', 'id')
            ->addForeignKey('product_id', 'products', 'id');

        $orders->addColumn('del_flg', 'smallinteger', [
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
        $orders->create();
    }
}
