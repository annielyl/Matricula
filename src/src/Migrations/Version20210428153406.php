<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428153406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carrinho (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, descricao VARCHAR(255) NOT NULL, INDEX IDX_A731E3C0DE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cartao (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, cvv VARCHAR(255) NOT NULL, data_validade VARCHAR(255) NOT NULL, INDEX IDX_A8D50C1EDE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_produto (categoria_id INT NOT NULL, produto_id INT NOT NULL, INDEX IDX_5EC3B6793397707A (categoria_id), INDEX IDX_5EC3B679105CFD56 (produto_id), PRIMARY KEY(categoria_id, produto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE endereco (id INT AUTO_INCREMENT NOT NULL, cep VARCHAR(255) NOT NULL, rua VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, estado VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, valor DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_carrinho (produto_id INT NOT NULL, carrinho_id INT NOT NULL, INDEX IDX_34022200105CFD56 (produto_id), INDEX IDX_34022200D363F3C2 (carrinho_id), PRIMARY KEY(produto_id, carrinho_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carrinho ADD CONSTRAINT FK_A731E3C0DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE cartao ADD CONSTRAINT FK_A8D50C1EDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE categoria_produto ADD CONSTRAINT FK_5EC3B6793397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categoria_produto ADD CONSTRAINT FK_5EC3B679105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_carrinho ADD CONSTRAINT FK_34022200105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_carrinho ADD CONSTRAINT FK_34022200D363F3C2 FOREIGN KEY (carrinho_id) REFERENCES carrinho (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produto_carrinho DROP FOREIGN KEY FK_34022200D363F3C2');
        $this->addSql('ALTER TABLE categoria_produto DROP FOREIGN KEY FK_5EC3B6793397707A');
        $this->addSql('ALTER TABLE carrinho DROP FOREIGN KEY FK_A731E3C0DE734E51');
        $this->addSql('ALTER TABLE cartao DROP FOREIGN KEY FK_A8D50C1EDE734E51');
        $this->addSql('ALTER TABLE categoria_produto DROP FOREIGN KEY FK_5EC3B679105CFD56');
        $this->addSql('ALTER TABLE produto_carrinho DROP FOREIGN KEY FK_34022200105CFD56');
        $this->addSql('DROP TABLE carrinho');
        $this->addSql('DROP TABLE cartao');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE categoria_produto');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE endereco');
        $this->addSql('DROP TABLE produto');
        $this->addSql('DROP TABLE produto_carrinho');
    }
}
