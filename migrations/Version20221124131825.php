<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221124131825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE listing_projects_filters (listing_projects_id INT NOT NULL, filters_id INT NOT NULL, INDEX IDX_AF7953CD49C0D607 (listing_projects_id), INDEX IDX_AF7953CD6B715464 (filters_id), PRIMARY KEY(listing_projects_id, filters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing_projects_filters ADD CONSTRAINT FK_AF7953CD49C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters ADD CONSTRAINT FK_AF7953CD6B715464 FOREIGN KEY (filters_id) REFERENCES filters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filters DROP FOREIGN KEY FK_7877678D71179CD6');
        $this->addSql('DROP INDEX IDX_7877678D71179CD6 ON filters');
        $this->addSql('ALTER TABLE filters DROP name_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing_projects_filters DROP FOREIGN KEY FK_AF7953CD49C0D607');
        $this->addSql('ALTER TABLE listing_projects_filters DROP FOREIGN KEY FK_AF7953CD6B715464');
        $this->addSql('DROP TABLE listing_projects_filters');
        $this->addSql('ALTER TABLE filters ADD name_id INT NOT NULL');
        $this->addSql('ALTER TABLE filters ADD CONSTRAINT FK_7877678D71179CD6 FOREIGN KEY (name_id) REFERENCES listing_projects (id)');
        $this->addSql('CREATE INDEX IDX_7877678D71179CD6 ON filters (name_id)');
    }
}
