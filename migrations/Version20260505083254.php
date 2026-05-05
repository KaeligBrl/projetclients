<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260505083254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing_projects ADD customer_id INT DEFAULT NULL, CHANGE enterprise enterprise VARCHAR(255) DEFAULT NULL, CHANGE domain_name domain_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE listing_projects ADD CONSTRAINT FK_BAEFD1DE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_BAEFD1DE9395C3F3 ON listing_projects (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing_projects DROP FOREIGN KEY FK_BAEFD1DE9395C3F3');
        $this->addSql('DROP INDEX IDX_BAEFD1DE9395C3F3 ON listing_projects');
        $this->addSql('ALTER TABLE listing_projects DROP customer_id, CHANGE enterprise enterprise VARCHAR(255) NOT NULL, CHANGE domain_name domain_name VARCHAR(255) NOT NULL');
    }
}
