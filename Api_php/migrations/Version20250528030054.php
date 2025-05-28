<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250528030054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__giftcard_produtos AS SELECT id, nome, logo_url, criado_em FROM giftcard_produtos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE giftcard_produtos
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE giftcard_produtos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, logo_url VARCHAR(255) NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO giftcard_produtos (id, nome, logo_url, criado_em) SELECT id, nome, logo_url, criado_em FROM __temp__giftcard_produtos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__giftcard_produtos
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE giftcard_produtos ADD COLUMN site VARCHAR(255) NOT NULL
        SQL);
    }
}
