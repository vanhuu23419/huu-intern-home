<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $alias
 * @property string $price
 * @property string $content
 * @property string|null $image_link
 * @property int|null $viewed
 * @property int|null $ordered
 * @property int $featured_flg
 * @property int $del_flg
 * @property int|null $created_by
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property int|null $updated_by
 * @property \Cake\I18n\FrozenTime|null $updated_at
 * @property int|null $deleted_by
 * @property int|null $deleted_at
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Order[] $orders
 */
class Product extends Entity
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
        'category_id' => true,
        'name' => true,
        'alias' => true,
        'price' => true,
        'content' => true,
        'image_link' => true,
        'viewed' => true,
        'ordered' => true,
        'featured_flg' => true,
        'del_flg' => true,
        'created_by' => true,
        'created_at' => true,
        'updated_by' => true,
        'updated_at' => true,
        'deleted_by' => true,
        'deleted_at' => true,
        'category' => true,
        'orders' => true,
    ];
}
