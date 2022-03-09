<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'user_flg' => 1,
                'phone' => 'Lorem ipsum dolor ',
                'address' => 'Lorem ipsum dolor sit amet',
                'del_flg' => 1,
                'created_by' => 1,
                'created_at' => '2022-03-04 06:42:32',
                'updated_by' => 1,
                'updated_at' => '2022-03-04 06:42:32',
                'deleted_by' => 1,
                'deleted_at' => 1,
            ],
        ];
        parent::init();
    }
}
