<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260504120517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visual_identity_project (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, customer_brief TINYINT(1) DEFAULT NULL, appointment_scheduled TINYINT(1) DEFAULT NULL, presentation_done TINYINT(1) DEFAULT NULL, rework_done TINYINT(1) DEFAULT NULL, validated TINYINT(1) DEFAULT NULL, declinations_done TINYINT(1) DEFAULT NULL, files_delivered TINYINT(1) DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, INDEX IDX_486219AE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visual_identity_project ADD CONSTRAINT FK_486219AE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visual_identity_project DROP FOREIGN KEY FK_486219AE9395C3F3');
        $this->addSql('DROP TABLE visual_identity_project');
    }
}
