<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150513141224 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE TermHistory (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, variations VARCHAR(255) DEFAULT NULL, pronunciation VARCHAR(255) DEFAULT NULL, nature VARCHAR(50) DEFAULT NULL, gender VARCHAR(50) DEFAULT NULL, number VARCHAR(50) DEFAULT NULL, origin LONGTEXT DEFAULT NULL, createdDate DATETIME NOT NULL, modifiedDate DATETIME NOT NULL, votesCount INT NOT NULL, type VARCHAR(50) NOT NULL, backupDate DATETIME NOT NULL, serializedCategory LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', serializedDefinitions LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', serializedExamples LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE TermHistory');
    }
}
