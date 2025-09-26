<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250925215933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(200) NOT NULL)');
        $this->addSql('CREATE TABLE emprestimo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idusuario BIGINT NOT NULL, idlivro BIGINT NOT NULL, diainicio INTEGER NOT NULL, mesinicio INTEGER NOT NULL, anoinicio INTEGER NOT NULL, diafinal INTEGER NOT NULL, mesfinal INTEGER NOT NULL, anofinal INTEGER NOT NULL, stsentregue BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE livro (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, idautor BIGINT NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE autor');
        $this->addSql('DROP TABLE emprestimo');
        $this->addSql('DROP TABLE livro');
    }
}
