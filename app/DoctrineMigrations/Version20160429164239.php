<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160429164239 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // Create Users Table
        $table = $schema->createTable('users');
        $table->addColumn('id', Type::INTEGER, [
            'autoincrement' => true,
            'notnull'       => true
        ]);
        $table->setPrimaryKey(['id']);
        $table->addColumn('username', Type::STRING, [
            'notnull' => true,
        ]);
        $table->addColumn('name', Type::STRING, [
            'notnull'  => true,
        ]);
        $table->addColumn('password', Type::TEXT, [
            'notnull' => true
        ]);
        $table->addColumn('role', Type::SIMPLE_ARRAY, [
            'notnull' => true,
            'default' => 'ROLE_CUSTOMER'
        ]);

        // Create Establishments Table
        $table = $schema->createTable('establishments');
        $table->addColumn('id', Type::INTEGER, [
            'autoincrement' => true,
            'notnull'       => true
        ]);
        $table->setPrimaryKey(['id']);
        $table->addColumn('title', Type::STRING, [
            'notnull' => true,
        ]);
        $table->addColumn('description', Type::TEXT, [
            'notnull' => false
        ]);
        $table->addColumn('owner_id', Type::INTEGER, [
            'notnull'  => true,
        ]);
        $table->addForeignKeyConstraint('users', ['owner_id'], ['id']);
        $table->addColumn('status', Type::STRING, [
            'notnull'  => true,
            'default'  => 'new'
        ]);

        // Create Specials Table
        $table = $schema->createTable('specials');
        $table->addColumn('id', Type::INTEGER, [
            'autoincrement' => true,
            'notnull'       => true
        ]);
        $table->setPrimaryKey(['id']);
        $table->addColumn('title', Type::STRING, [
            'notnull' => true,
        ]);
        $table->addColumn('description', Type::TEXT, [
            'notnull' => false
        ]);
        $table->addColumn('start_date', Type::DATE, [
            'notnull' => true,
        ]);
        $table->addColumn('end_date', Type::DATE, [
            'notnull' => true,
        ]);
        $table->addColumn('type', Type::STRING, [
            'notnull' => true 
        ]);
        $table->addColumn('establishment_id', Type::INTEGER, [
            'notnull'  => true,
        ]);
        $table->addForeignKeyConstraint('establishments', ['establishment_id'], ['id']);
        $table->addColumn('count', Type::INTEGER, [
            'notnull'  => true,
            'default'  => 1
        ]);
        $table->addColumn('status', Type::STRING, [
            'notnull'  => true,
            'default'  => 'new'
        ]);

        // Create Worker Table
        $table = $schema->createTable('workers');
        $table->addColumn('id', Type::INTEGER, [
            'autoincrement' => true,
            'notnull'       => true
        ]);
        $table->setPrimaryKey(['id']);
        $table->addColumn('status', Type::STRING, [
            'notnull' => true,
            'default' => 'worked'
        ]);
        $table->addColumn('user_id', Type::INTEGER, [
            'notnull' => true
        ]);
        $table->addForeignKeyConstraint('users', ['user_id'], ['id']);
        $table->addColumn('establishment_id', Type::INTEGER, [
            'notnull' => true
        ]);
        $table->addForeignKeyConstraint('establishments', ['establishment_id'], ['id']);

        // Create Departments Table
        $table = $schema->createTable('departments');
        $table->addColumn('id', Type::INTEGER, [
            'autoincrement' => true,
            'notnull'       => true
        ]);
        $table->setPrimaryKey(['id']);
        $table->addColumn('address', Type::TEXT, [
            'notnull' => true,
        ]);
        $table->addColumn('establishment_id', Type::INTEGER, [
            'notnull' => true
        ]);
        $table->addForeignKeyConstraint('establishments', ['establishment_id'], ['id']);

        // Create Customers Specials Table
        $table = $schema->createTable('customers_specials');
        $table->addColumn('id', Type::INTEGER, [
            'autoincrement' => true,
            'notnull'       => true
        ]);
        $table->setPrimaryKey(['id']);
        $table->addColumn('customer_id', Type::INTEGER, [
            'notnull' => true
        ]);
        $table->addForeignKeyConstraint('users', ['customer_id'], ['id']);
        $table->addColumn('special_id', Type::INTEGER, [
            'notnull' => true
        ]);
        $table->addForeignKeyConstraint('specials', ['special_id'], ['id']);
        $table->addColumn('uses_count', Type::BIGINT, [
            'default' => 0
        ]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // Drop Customers Specials Table
        $schema->dropTable('customers_specials');
        // Drop Departments Table
        $schema->dropTable('departments');
        // Drop Worker Table
        $schema->dropTable('workers');
        // Drop Specials Table
        $schema->dropTable('specials');
        // Drop Establishments Table
        $schema->dropTable('establishments');
        // Drop Users Table
        $schema->dropTable('users');
    }
}
