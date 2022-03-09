<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
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
                'category_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'alias' => 'Lorem ipsum dolor sit amet',
                'price' => 1.5,
                'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'image_link' => 'Lorem ipsum dolor sit amet',
                'viewed' => 1,
                'ordered' => 1,
                'featured_flg' => 1,
                'del_flg' => 1,
                'created_by' => 1,
                'created_at' => '2022-03-03 09:11:02',
                'updated_by' => 1,
                'updated_at' => '2022-03-03 09:11:02',
                'deleted_by' => 1,
                'deleted_at' => 1,
            ],
        ];
        parent::init();
    }
}
