<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260505135707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE website_billing ADD deposit_paid TINYINT(1) DEFAULT 0 NOT NULL, ADD mockup_sent_paid TINYINT(1) DEFAULT 0 NOT NULL, ADD onboarding_training_paid TINYINT(1) DEFAULT 0 NOT NULL, ADD status_paid TINYINT(1) DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE website_billing DROP deposit_paid, DROP mockup_sent_paid, DROP onboarding_training_paid, DROP status_paid');
    }
}
