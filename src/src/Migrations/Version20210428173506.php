<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428173506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carrinho CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE endereco ADD cliente_id INT DEFAULT NULL, CHANGE rua logradouro VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE endereco ADD CONSTRAINT FK_F8E0D60EDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F8E0D60EDE734E51 ON endereco (cliente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carrinho CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE endereco DROP FOREIGN KEY FK_F8E0D60EDE734E51');
        $this->addSql('DROP INDEX UNIQ_F8E0D60EDE734E51 ON endereco');
        $this->addSql('ALTER TABLE endereco DROP cliente_id, CHANGE logradouro rua VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
