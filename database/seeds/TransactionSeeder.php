<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class TransactionSeeder extends AbstractSeed
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
        $data = 
        [
            [
                'id' => 1,
                'invoice_id' => 'INV-PHP-25022024',
                'item_name' => 'Laptop Kerja',
                'amount' => 5000000,
                'payment_type' => 'e_wallet',
                'customer_name' => 'Zakaria',
                'number_va' => '',
                'merchant_id' => 2,
                'status' => 'Pending'

            ]
        ];

        $transaction = $this->table('transactions');
        $transaction->insert($data)
              ->saveData();
    }
}
