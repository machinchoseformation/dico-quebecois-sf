<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150513123131 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE termhistory DROP FOREIGN KEY FK_74FE18EE12469DE2');
        $this->addSql('DROP INDEX IDX_74FE18EE12469DE2 ON termhistory');
        $this->addSql('ALTER TABLE termhistory ADD serializedCategory LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', ADD jsonDefinitions LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', ADD jsonExamples LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', DROP category_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE TermHistory ADD category_id INT DEFAULT NULL, DROP serializedCategory, DROP jsonDefinitions, DROP jsonExamples');
        $this->addSql('ALTER TABLE TermHistory ADD CONSTRAINT FK_74FE18EE12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_74FE18EE12469DE2 ON TermHistory (category_id)');
    }
}
