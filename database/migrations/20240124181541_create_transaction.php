<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTransaction extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('transactions');
        $table->addcolumn('invoice_id', 'string')
            ->addcolumn('item_name', 'string')
            ->addcolumn('amount', 'integer')
            ->addcolumn('payment_type', 'string', ['limit' => 50])
            ->addcolumn('customer_name', 'string', ['limit' => 50])
            ->addColumn('number_va', 'string', ['limit' => 25])
            ->addColumn('merchant_id', 'integer')
            ->addcolumn('status', 'string', ['limit' => 10])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
