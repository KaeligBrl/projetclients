<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221124133513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filters ADD name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE listing_projects ADD filter_id INT NOT NULL');
        $this->addSql('ALTER TABLE listing_projects ADD CONSTRAINT FK_BAEFD1DED395B25E FOREIGN KEY (filter_id) REFERENCES filters (id)');
        $this->addSql('CREATE INDEX IDX_BAEFD1DED395B25E ON listing_projects (filter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filters DROP name');
        $this->addSql('ALTER TABLE listing_projects DROP FOREIGN KEY FK_BAEFD1DED395B25E');
        $this->addSql('DROP INDEX IDX_BAEFD1DED395B25E ON listing_projects');
        $this->addSql('ALTER TABLE listing_projects DROP filter_id');
    }
}
