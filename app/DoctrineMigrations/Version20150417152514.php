<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150417152514 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Definition (id INT AUTO_INCREMENT NOT NULL, term_id INT DEFAULT NULL, content LONGTEXT NOT NULL, createdDate DATETIME NOT NULL, modifiedDate DATETIME NOT NULL, INDEX IDX_276D2C08E2C35FC (term_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Example (id INT AUTO_INCREMENT NOT NULL, term_id INT DEFAULT NULL, content LONGTEXT NOT NULL, translation LONGTEXT DEFAULT NULL, createdDate DATETIME NOT NULL, modifiedDate DATETIME NOT NULL, INDEX IDX_A151A203E2C35FC (term_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Term (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, variations VARCHAR(255) DEFAULT NULL, pronunciation VARCHAR(255) DEFAULT NULL, nature VARCHAR(50) DEFAULT NULL, gender VARCHAR(50) DEFAULT NULL, number VARCHAR(50) DEFAULT NULL, origin LONGTEXT DEFAULT NULL, createdDate DATETIME NOT NULL, modifiedDate DATETIME NOT NULL, votesCount INT NOT NULL, INDEX IDX_53D48B312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TermHistory (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, variations VARCHAR(255) DEFAULT NULL, pronunciation VARCHAR(255) DEFAULT NULL, nature VARCHAR(50) DEFAULT NULL, gender VARCHAR(50) DEFAULT NULL, number VARCHAR(50) DEFAULT NULL, origin LONGTEXT DEFAULT NULL, createdDate DATETIME NOT NULL, modifiedDate DATETIME NOT NULL, votesCount INT NOT NULL, type VARCHAR(50) NOT NULL, backupDate DATETIME NOT NULL, INDEX IDX_74FE18EE12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Definition ADD CONSTRAINT FK_276D2C08E2C35FC FOREIGN KEY (term_id) REFERENCES Term (id)');
        $this->addSql('ALTER TABLE Example ADD CONSTRAINT FK_A151A203E2C35FC FOREIGN KEY (term_id) REFERENCES Term (id)');
        $this->addSql('ALTER TABLE Term ADD CONSTRAINT FK_53D48B312469DE2 FOREIGN KEY (category_id) REFERENCES Category (id)');
        $this->addSql('ALTER TABLE TermHistory ADD CONSTRAINT FK_74FE18EE12469DE2 FOREIGN KEY (category_id) REFERENCES Category (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Term DROP FOREIGN KEY FK_53D48B312469DE2');
        $this->addSql('ALTER TABLE TermHistory DROP FOREIGN KEY FK_74FE18EE12469DE2');
        $this->addSql('ALTER TABLE Definition DROP FOREIGN KEY FK_276D2C08E2C35FC');
        $this->addSql('ALTER TABLE Example DROP FOREIGN KEY FK_A151A203E2C35FC');
        $this->addSql('DROP TABLE Category');
        $this->addSql('DROP TABLE Definition');
        $this->addSql('DROP TABLE Example');
        $this->addSql('DROP TABLE Term');
        $this->addSql('DROP TABLE TermHistory');
    }
}
