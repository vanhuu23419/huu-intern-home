<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateTransactions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('transactions', [ 
            'id' => false, 
            'primary_key' => 'id', 
        ]);
        $table->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
            ])
            ->addColumn('user_id', 'biginteger')
            ->addColumn('amount', 'decimal', [ 
                'default' => 0,
                'precision' => 15,
                'scale' => 4,
            ])
            ->addColumn('payment', 'smallinteger', [
                'default' => 0,
                'comment' => '0:COD;1:Momo;2:ViettelPay',
            ])
            ->addColumn('payment_info', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('message', 'text', [
                'null' => true,
            ])
            ->addColumn('security', 'string', [
                'null' => true,
                'limit' => 16,
            ])
            ->addColumn('status_flg', 'smallinteger', [
                'default' => 0,
                'comment' => '0:unpaid;1:paid;2:cancel;3:error',
            ])
            ->addForeignKey('user_id', 'users', 'id');
        
        $table->addColumn('del_flg', 'smallinteger', [
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
        $table->create();

    }
}
