<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250925224659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__emprestimo AS SELECT id, idusuario, idlivro, diainicio, mesinicio, anoinicio, diafinal, mesfinal, anofinal, stsentregue FROM emprestimo');
        $this->addSql('DROP TABLE emprestimo');
        $this->addSql('CREATE TABLE emprestimo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idusuario INTEGER DEFAULT NULL, idlivro INTEGER DEFAULT NULL, diainicio INTEGER NOT NULL, mesinicio INTEGER NOT NULL, anoinicio INTEGER NOT NULL, diafinal INTEGER NOT NULL, mesfinal INTEGER NOT NULL, anofinal INTEGER NOT NULL, stsentregue BOOLEAN NOT NULL, CONSTRAINT FK_E6813B92FD61E233 FOREIGN KEY (idusuario) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E6813B929AB3CA9E FOREIGN KEY (idlivro) REFERENCES livro (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO emprestimo (id, idusuario, idlivro, diainicio, mesinicio, anoinicio, diafinal, mesfinal, anofinal, stsentregue) SELECT id, idusuario, idlivro, diainicio, mesinicio, anoinicio, diafinal, mesfinal, anofinal, stsentregue FROM __temp__emprestimo');
        $this->addSql('DROP TABLE __temp__emprestimo');
        $this->addSql('CREATE INDEX IDX_E6813B92FD61E233 ON emprestimo (idusuario)');
        $this->addSql('CREATE INDEX IDX_E6813B929AB3CA9E ON emprestimo (idlivro)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__livro AS SELECT id, nome, idautor FROM livro');
        $this->addSql('DROP TABLE livro');
        $this->addSql('CREATE TABLE livro (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idautor INTEGER DEFAULT NULL, nome VARCHAR(200) NOT NULL, CONSTRAINT FK_4CB6A687E70232A3 FOREIGN KEY (idautor) REFERENCES autor (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO livro (id, nome, idautor) SELECT id, nome, idautor FROM __temp__livro');
        $this->addSql('DROP TABLE __temp__livro');
        $this->addSql('CREATE INDEX IDX_4CB6A687E70232A3 ON livro (idautor)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__emprestimo AS SELECT id, idusuario, idlivro, diainicio, mesinicio, anoinicio, diafinal, mesfinal, anofinal, stsentregue FROM emprestimo');
        $this->addSql('DROP TABLE emprestimo');
        $this->addSql('CREATE TABLE emprestimo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idusuario BIGINT NOT NULL, idlivro BIGINT NOT NULL, diainicio INTEGER NOT NULL, mesinicio INTEGER NOT NULL, anoinicio INTEGER NOT NULL, diafinal INTEGER NOT NULL, mesfinal INTEGER NOT NULL, anofinal INTEGER NOT NULL, stsentregue BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO emprestimo (id, idusuario, idlivro, diainicio, mesinicio, anoinicio, diafinal, mesfinal, anofinal, stsentregue) SELECT id, idusuario, idlivro, diainicio, mesinicio, anoinicio, diafinal, mesfinal, anofinal, stsentregue FROM __temp__emprestimo');
        $this->addSql('DROP TABLE __temp__emprestimo');
        $this->addSql('CREATE TEMPORARY TABLE __temp__livro AS SELECT id, idautor, nome FROM livro');
        $this->addSql('DROP TABLE livro');
        $this->addSql('CREATE TABLE livro (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idautor BIGINT NOT NULL, nome VARCHAR(200) NOT NULL)');
        $this->addSql('INSERT INTO livro (id, idautor, nome) SELECT id, idautor, nome FROM __temp__livro');
        $this->addSql('DROP TABLE __temp__livro');
    }
}
