<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202101936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filters_activities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_projects_filters_activities (listing_projects_id INT NOT NULL, filters_activities_id INT NOT NULL, INDEX IDX_C1C9830F49C0D607 (listing_projects_id), INDEX IDX_C1C9830FD6276D3E (filters_activities_id), PRIMARY KEY(listing_projects_id, filters_activities_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing_projects_filters_activities ADD CONSTRAINT FK_C1C9830F49C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters_activities ADD CONSTRAINT FK_C1C9830FD6276D3E FOREIGN KEY (filters_activities_id) REFERENCES filters_activities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters DROP FOREIGN KEY FK_AF7953CD49C0D607');
        $this->addSql('ALTER TABLE listing_projects_filters DROP FOREIGN KEY FK_AF7953CD6B715464');
        $this->addSql('DROP TABLE filters');
        $this->addSql('DROP TABLE listing_projects_filters');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE listing_projects_filters (listing_projects_id INT NOT NULL, filters_id INT NOT NULL, INDEX IDX_AF7953CD49C0D607 (listing_projects_id), INDEX IDX_AF7953CD6B715464 (filters_id), PRIMARY KEY(listing_projects_id, filters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE listing_projects_filters ADD CONSTRAINT FK_AF7953CD49C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters ADD CONSTRAINT FK_AF7953CD6B715464 FOREIGN KEY (filters_id) REFERENCES filters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters_activities DROP FOREIGN KEY FK_C1C9830F49C0D607');
        $this->addSql('ALTER TABLE listing_projects_filters_activities DROP FOREIGN KEY FK_C1C9830FD6276D3E');
        $this->addSql('DROP TABLE filters_activities');
        $this->addSql('DROP TABLE listing_projects_filters_activities');
    }
}
