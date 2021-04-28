<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428043001 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto ADD carrinho_id INT NOT NULL');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D7D363F3C2 FOREIGN KEY (carrinho_id) REFERENCES carrinho (id)');
        $this->addSql('CREATE INDEX IDX_5CAC49D7D363F3C2 ON produto (carrinho_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D7D363F3C2');
        $this->addSql('DROP INDEX IDX_5CAC49D7D363F3C2 ON produto');
        $this->addSql('ALTER TABLE produto DROP carrinho_id');
    }
}
