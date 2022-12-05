<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205160017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filters_enterprises (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_projects_filters_enterprises (listing_projects_id INT NOT NULL, filters_enterprises_id INT NOT NULL, INDEX IDX_C21D1E9149C0D607 (listing_projects_id), INDEX IDX_C21D1E9187942432 (filters_enterprises_id), PRIMARY KEY(listing_projects_id, filters_enterprises_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing_projects_filters_enterprises ADD CONSTRAINT FK_C21D1E9149C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters_enterprises ADD CONSTRAINT FK_C21D1E9187942432 FOREIGN KEY (filters_enterprises_id) REFERENCES filters_enterprises (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing_projects_filters_enterprises DROP FOREIGN KEY FK_C21D1E9149C0D607');
        $this->addSql('ALTER TABLE listing_projects_filters_enterprises DROP FOREIGN KEY FK_C21D1E9187942432');
        $this->addSql('DROP TABLE filters_enterprises');
        $this->addSql('DROP TABLE listing_projects_filters_enterprises');
    }
}
