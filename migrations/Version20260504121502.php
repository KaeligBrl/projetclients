<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260504121502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visual_identity_billing (id INT AUTO_INCREMENT NOT NULL, visual_identity_project_id INT NOT NULL, label VARCHAR(255) NOT NULL, deposit TINYINT(1) DEFAULT 0 NOT NULL, status TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_8BF385EA8D1B1C7E (visual_identity_project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visual_identity_billing ADD CONSTRAINT FK_8BF385EA8D1B1C7E FOREIGN KEY (visual_identity_project_id) REFERENCES visual_identity_project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visual_identity_billing DROP FOREIGN KEY FK_8BF385EA8D1B1C7E');
        $this->addSql('DROP TABLE visual_identity_billing');
    }
}
