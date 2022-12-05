<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202112915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE listing_projects_filters_websites_types (listing_projects_id INT NOT NULL, filters_websites_types_id INT NOT NULL, INDEX IDX_81F2C56949C0D607 (listing_projects_id), INDEX IDX_81F2C5694F939435 (filters_websites_types_id), PRIMARY KEY(listing_projects_id, filters_websites_types_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing_projects_filters_websites_types ADD CONSTRAINT FK_81F2C56949C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters_websites_types ADD CONSTRAINT FK_81F2C5694F939435 FOREIGN KEY (filters_websites_types_id) REFERENCES filters_websites_types (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing_projects_filters_websites_types DROP FOREIGN KEY FK_81F2C56949C0D607');
        $this->addSql('ALTER TABLE listing_projects_filters_websites_types DROP FOREIGN KEY FK_81F2C5694F939435');
        $this->addSql('DROP TABLE listing_projects_filters_websites_types');
    }
}
