<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Locator\LocatorAwareTrait;
use App\Model\Table\UsersTable;
/**
 * Products seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */

    private function seedUsers($total) {
        
        $table = new UsersTable();
        
        for($i = 0; $i < $total; ++$i) {
            $newUserId = $table->find()->select([
                'newId' => 'MAX(id) + 1'
            ])->first()->newId;
            $hasher = new DefaultPasswordHasher();
            $data = [
                'email' => 'user'.$newUserId.'@example.com',
                'password' => $hasher->hash('123456'),
                'name' => 'User'.$newUserId,
                'user_flg' => rand(0, 2),
                'phone' => '123321123',
                'address' => '123 AbcDef, Ghtk',
                'created_at' => time(),
                'created_by' => 1,
            ];
            // insert
            $table->query()
                ->insert(['email','password','name','user_flg','phone','address', 'created_at', 'created_by'])
                ->values($data)
                ->execute();
        }
    }

    public function run()
    {
        $this->seedUsers(100);
    }
}
