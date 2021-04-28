<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428043920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carrinho ADD cliente_id INT NOT NULL');
        $this->addSql('ALTER TABLE carrinho ADD CONSTRAINT FK_A731E3C0DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_A731E3C0DE734E51 ON carrinho (cliente_id)');
        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carrinho DROP FOREIGN KEY FK_A731E3C0DE734E51');
        $this->addSql('DROP INDEX IDX_A731E3C0DE734E51 ON carrinho');
        $this->addSql('ALTER TABLE carrinho DROP cliente_id');
        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
    }
}
