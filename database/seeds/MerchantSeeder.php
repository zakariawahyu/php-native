<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class MerchantSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'name' => 'ShopeePay',
            ],[
                'id'    => 2,
                'name' => 'OVO',
            ],[
                'id'    => 3,
                'name' => 'DANA',
            ],[
                'id'    => 4,
                'name' => 'Gopay',
            ],[
                'id'    => 5,
                'name' => 'LinkAja',
            ],[
                'id'    => 6,
                'name' => 'OVO',
            ],[
                'id'    => 7,
                'name' => 'BCA',
            ],[
                'id'    => 8,
                'name' => 'BRI',
            ],[
                'id'    => 9,
                'name' => 'BNI',
            ],[
                'id'    => 10,
                'name' => 'Mandiri',
            ]
        ];

        $merchant = $this->table('merchants');
        $merchant->insert($data)
              ->saveData();
    }
}
