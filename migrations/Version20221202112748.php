<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202112748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filters_websites_types_listing_projects (filters_websites_types_id INT NOT NULL, listing_projects_id INT NOT NULL, INDEX IDX_EC73ED24F939435 (filters_websites_types_id), INDEX IDX_EC73ED249C0D607 (listing_projects_id), PRIMARY KEY(filters_websites_types_id, listing_projects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filters_websites_types_listing_projects ADD CONSTRAINT FK_EC73ED24F939435 FOREIGN KEY (filters_websites_types_id) REFERENCES filters_websites_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filters_websites_types_listing_projects ADD CONSTRAINT FK_EC73ED249C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filters_websites_types_listing_projects DROP FOREIGN KEY FK_EC73ED24F939435');
        $this->addSql('ALTER TABLE filters_websites_types_listing_projects DROP FOREIGN KEY FK_EC73ED249C0D607');
        $this->addSql('DROP TABLE filters_websites_types_listing_projects');
    }
}
