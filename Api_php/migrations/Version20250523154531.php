<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250523154531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE usuarios (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cpf VARCHAR(14) NOT NULL, nome VARCHAR(255) NOT NULL, nome_usuario VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(255) DEFAULT NULL, senha VARCHAR(255) NOT NULL, tipo INTEGER NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EF687F23E3E11F0 ON usuarios (cpf)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EF687F27878DEE5 ON usuarios (nome_usuario)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EF687F2E7927C74 ON usuarios (email)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE usuarios
        SQL);
    }
}
