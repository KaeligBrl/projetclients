<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202112656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filters_websites_types_filters_activities DROP FOREIGN KEY FK_2E8318F84F939435');
        $this->addSql('ALTER TABLE filters_websites_types_filters_activities DROP FOREIGN KEY FK_2E8318F8D6276D3E');
        $this->addSql('DROP TABLE filters_websites_types_filters_activities');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filters_websites_types_filters_activities (filters_websites_types_id INT NOT NULL, filters_activities_id INT NOT NULL, INDEX IDX_2E8318F84F939435 (filters_websites_types_id), INDEX IDX_2E8318F8D6276D3E (filters_activities_id), PRIMARY KEY(filters_websites_types_id, filters_activities_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE filters_websites_types_filters_activities ADD CONSTRAINT FK_2E8318F84F939435 FOREIGN KEY (filters_websites_types_id) REFERENCES filters_websites_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filters_websites_types_filters_activities ADD CONSTRAINT FK_2E8318F8D6276D3E FOREIGN KEY (filters_activities_id) REFERENCES filters_activities (id) ON DELETE CASCADE');
    }
}
