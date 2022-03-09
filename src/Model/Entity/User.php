<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Libs\ValueUtil;
use App\Libs\ConfigUtil;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property int $user_flg
 * @property string|null $phone
 * @property string|null $address
 * @property int $del_flg
 * @property int|null $created_by
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property int|null $updated_by
 * @property \Cake\I18n\FrozenTime|null $updated_at
 * @property int|null $deleted_by
 * @property int|null $deleted_at
 *
 * @property \App\Model\Entity\Transaction[] $transactions
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'name' => true,
        'user_flg' => true,
        'phone' => true,
        'address' => true,
        'del_flg' => true,
        'created_by' => true,
        'created_at' => true,
        'updated_by' => true,
        'updated_at' => true,
        'deleted_by' => true,
        'deleted_at' => true,
        'transactions' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Is this user soft deleted
     */
    public function isDeleted() {
        $arr = ConfigUtil::loadValueList('common', 'del_flg');
        $del_flg = $arr[$this->del_flg]; 
        return  $del_flg != 'no';
    }

    /**
     * Is this user_flg = 0:admin
     * 
     * @return boolean 
     */
    public function isAdmin() {
        $arr = ConfigUtil::loadValueList('users', 'user_flg');
        $user_flg = $arr[$this->user_flg];
        return $user_flg == 'admin';
    }

    /**
     * Get users.user_flg values
     * 
     * @return array array of user_flg
     */
    public function getUserFlagName() {
        $arr = ConfigUtil::loadValueList('users', 'user_flg');
        $user_flg = $arr[$this->user_flg];
        return $user_flg;
    }
}
