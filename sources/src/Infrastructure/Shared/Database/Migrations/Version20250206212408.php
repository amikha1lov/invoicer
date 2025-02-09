<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206212408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE banks (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, bik VARCHAR(20) NOT NULL, inn VARCHAR(20) NOT NULL, kpp VARCHAR(20) NOT NULL, account_number VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clients (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE invoice_items (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, price VARCHAR(255) NOT NULL, invoice_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DCC4B9F82989F1FD ON invoice_items (invoice_id)');
        $this->addSql('CREATE TABLE invoices (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, number VARCHAR(255) NOT NULL, date DATE NOT NULL, bank_id INT DEFAULT NULL, client_id INT DEFAULT NULL, supplier_id INT DEFAULT NULL, user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2F2F9511C8FB41 ON invoices (bank_id)');
        $this->addSql('CREATE INDEX IDX_6A2F2F9519EB6921 ON invoices (client_id)');
        $this->addSql('CREATE INDEX IDX_6A2F2F952ADD6D8C ON invoices (supplier_id)');
        $this->addSql('CREATE INDEX IDX_6A2F2F95A76ED395 ON invoices (user_id)');
        $this->addSql('CREATE TABLE suppliers (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE telegram_users (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, chat_id VARCHAR(50) NOT NULL, user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_948A6AB1A9A7125 ON telegram_users (chat_id)');
        $this->addSql('CREATE INDEX IDX_948A6ABA76ED395 ON telegram_users (user_id)');
        $this->addSql('CREATE TABLE users (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE invoice_items ADD CONSTRAINT FK_DCC4B9F82989F1FD FOREIGN KEY (invoice_id) REFERENCES invoices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F9511C8FB41 FOREIGN KEY (bank_id) REFERENCES banks (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F9519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F952ADD6D8C FOREIGN KEY (supplier_id) REFERENCES suppliers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F95A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE telegram_users ADD CONSTRAINT FK_948A6ABA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_items DROP CONSTRAINT FK_DCC4B9F82989F1FD');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F9511C8FB41');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F9519EB6921');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F952ADD6D8C');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F95A76ED395');
        $this->addSql('ALTER TABLE telegram_users DROP CONSTRAINT FK_948A6ABA76ED395');
        $this->addSql('DROP TABLE banks');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE invoice_items');
        $this->addSql('DROP TABLE invoices');
        $this->addSql('DROP TABLE suppliers');
        $this->addSql('DROP TABLE telegram_users');
        $this->addSql('DROP TABLE users');
    }
}
