<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250528014547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE dados_banco (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, usuario_id VARCHAR(255) NOT NULL, numero_cartao VARCHAR(255) NOT NULL, nome_titular VARCHAR(255) NOT NULL, validade VARCHAR(255) NOT NULL, cvv VARCHAR(255) NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE giftcard_produtos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, logo_url VARCHAR(255) NOT NULL, site VARCHAR(255) NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE giftcard_seriais (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, venda_id VARCHAR(255) DEFAULT NULL, giftcard_value_id INTEGER DEFAULT NULL, codigo_serial VARCHAR(255) NOT NULL, gerado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , status VARCHAR(255) NOT NULL, CONSTRAINT FK_D71D23C7924517DF FOREIGN KEY (venda_id) REFERENCES vendas (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D71D23C7A2C0C74D FOREIGN KEY (giftcard_value_id) REFERENCES giftcard_values (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_D71D23C7AD966630 ON giftcard_seriais (codigo_serial)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D71D23C7924517DF ON giftcard_seriais (venda_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D71D23C7A2C0C74D ON giftcard_seriais (giftcard_value_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE giftcard_values (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, giftcard_produto_id INTEGER DEFAULT NULL, valor DOUBLE PRECISION NOT NULL, descricao VARCHAR(255) NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , CONSTRAINT FK_8622280190097482 FOREIGN KEY (giftcard_produto_id) REFERENCES giftcard_produtos (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8622280190097482 ON giftcard_values (giftcard_produto_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pagamentos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, venda_id VARCHAR(255) DEFAULT NULL, metodo_pagamento VARCHAR(255) NOT NULL, cartao_id VARCHAR(255) DEFAULT NULL, id_externo VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , CONSTRAINT FK_EFE46511924517DF FOREIGN KEY (venda_id) REFERENCES vendas (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EFE46511924517DF ON pagamentos (venda_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE usuarios (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cpf VARCHAR(11) NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(11) DEFAULT NULL, senha VARCHAR(255) NOT NULL, tipo INTEGER NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EF687F23E3E11F0 ON usuarios (cpf)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EF687F2E7927C74 ON usuarios (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vendas (id VARCHAR(255) NOT NULL, giftcard_value_id INTEGER DEFAULT NULL, usuario_id VARCHAR(255) NOT NULL, valor DOUBLE PRECISION NOT NULL, criado_em DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , PRIMARY KEY(id), CONSTRAINT FK_1CA62EEEA2C0C74D FOREIGN KEY (giftcard_value_id) REFERENCES giftcard_values (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1CA62EEEA2C0C74D ON vendas (giftcard_value_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE dados_banco
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE giftcard_produtos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE giftcard_seriais
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE giftcard_values
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pagamentos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE usuarios
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vendas
        SQL);
    }
}
