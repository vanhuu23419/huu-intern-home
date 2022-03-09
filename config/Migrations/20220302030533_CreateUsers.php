<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        // Create Users table
        $users = $this->table('users', ['id' => false, 'primary_key' => ['id']]);
        $users->addColumn('id', 'biginteger', [
                'autoIncrement' => true,
            ])
            ->addColumn('email', 'string', [
                'limit' => 50, 
                'comment' => 'unique',
            ])
            ->addColumn('password', 'string', [
                'limit' => 255, 
                'comment' => 'encryption',
            ])
            ->addColumn('name', 'string', [
                'limit' => 50,
            ])
            ->addColumn('user_flg', 'smallinteger', [
                'default' => 1, 
                'comment' => '0:admin;1:user;2:support'
            ])
            ->addColumn('phone', 'string', [
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('address', 'string', [
                'null' => true,
            ]);
        $users->addColumn('del_flg', 'smallinteger', [
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
        $users->create();
    }
}
