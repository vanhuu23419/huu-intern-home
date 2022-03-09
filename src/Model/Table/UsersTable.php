<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Collection\Collection;
use App\Libs\ConfigUtil;

/**
 * Users Model
 *
 * @property \App\Model\Table\TransactionsTable&\Cake\ORM\Association\HasMany $Transactions
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Transactions', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmptyString('id', null, 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->notEmptyString('user_flg');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmptyString('phone');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmptyString('address');

        $validator
            ->notEmptyString('del_flg');

        $validator
            ->allowEmptyString('created_by');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->allowEmptyString('updated_by');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        $validator
            ->allowEmptyString('deleted_by');

        $validator
            ->allowEmptyString('deleted_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }

    /**
     * Get User by email
     *
     * @param string email to compare with 
     * @return App\Model\Entity user with $email
     */
    public function getByEmail($email) {
        return  $this->find()
                    ->where([
                        'email' => $email
                    ])
                    ->first();
    }

    /**
     * Get User by id
     *
     * @param int user id 
     * @return App\Model\Entity user with $id
     */
    public function getById($id) {
        return  $this->find()
                    ->where([
                        'id' => $id
                    ])
                    ->first();
    }

    /**
     * Build the search query
     * 
     * @param array $options option to build the query
     * @param int $total the number of records matches options without pagination
     * 
     * @return Cake\ORM\Query 
     */
    public function buildSearchQuery($_options) {
        /**
         * Build query with options
         */
        $options = [
            'email' => '',
            'name' => '',
            'phone' => '',
            'user_flg' => [],
        ];
        foreach($_options as $key => $val) {
            $options[$key] = $val;
        }

        // where    
        $whereConditions = [];
        $whereConditions[] = ["del_flg" => 0];
        if ($options['email']) {
            $whereConditions[] = ["email" => $options['email']];
        }
        if ($options['name']) {
            $whereConditions[] = ["name LIKE" => "%{$options['name']}%"];
        }
        if ($options['phone']) {
            $whereConditions[] = ["phone LIKE" => "%{$options['phone']}%"];
        }
        if (count($options['user_flg']) > 0) {
            $whereConditions[] = ["user_flg IN" => $options['user_flg']];
        }

        $searchQuery = $this->find()->where($whereConditions);
        return $searchQuery;
    }

    /**
     * Get user flags with keys & names
     * 
     * @return array array of user flags
     */
    public function getUserFlags() {
        return ConfigUtil::loadValueList('users', 'user_flg');
    }


    /**
     * Get user flags with keys & names
     * 
     * @return array array of user flags
     */
    public function softDelete($id, $deleted_by) {
        // soft delete
        $this->query()->update()
            ->set([
                'del_flg' => 1,
                'deleted_by' => $deleted_by,
                'deleted_at' => time()
            ])
            ->where(['id' => $id])
            ->execute();
    }
}
