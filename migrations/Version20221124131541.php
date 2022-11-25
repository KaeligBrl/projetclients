<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221124131541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filters_listing_projects DROP FOREIGN KEY FK_3BCFC1A749C0D607');
        $this->addSql('ALTER TABLE filters_listing_projects DROP FOREIGN KEY FK_3BCFC1A76B715464');
        $this->addSql('DROP TABLE filters_listing_projects');
        $this->addSql('ALTER TABLE filters ADD name_id INT NOT NULL');
        $this->addSql('ALTER TABLE filters ADD CONSTRAINT FK_7877678D71179CD6 FOREIGN KEY (name_id) REFERENCES listing_projects (id)');
        $this->addSql('CREATE INDEX IDX_7877678D71179CD6 ON filters (name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filters_listing_projects (filters_id INT NOT NULL, listing_projects_id INT NOT NULL, INDEX IDX_3BCFC1A749C0D607 (listing_projects_id), INDEX IDX_3BCFC1A76B715464 (filters_id), PRIMARY KEY(filters_id, listing_projects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE filters_listing_projects ADD CONSTRAINT FK_3BCFC1A749C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filters_listing_projects ADD CONSTRAINT FK_3BCFC1A76B715464 FOREIGN KEY (filters_id) REFERENCES filters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filters DROP FOREIGN KEY FK_7877678D71179CD6');
        $this->addSql('DROP INDEX IDX_7877678D71179CD6 ON filters');
        $this->addSql('ALTER TABLE filters DROP name_id');
    }
}
