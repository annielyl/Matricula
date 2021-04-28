<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428141226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_produto (categoria_id INT NOT NULL, produto_id INT NOT NULL, INDEX IDX_5EC3B6793397707A (categoria_id), INDEX IDX_5EC3B679105CFD56 (produto_id), PRIMARY KEY(categoria_id, produto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categoria_produto ADD CONSTRAINT FK_5EC3B6793397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categoria_produto ADD CONSTRAINT FK_5EC3B679105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carrinho CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto CHANGE carrinho_id carrinho_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categoria_produto DROP FOREIGN KEY FK_5EC3B6793397707A');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE categoria_produto');
        $this->addSql('ALTER TABLE carrinho CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cartao CHANGE cliente_id cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto CHANGE carrinho_id carrinho_id INT DEFAULT NULL');
    }
}
