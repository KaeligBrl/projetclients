<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260506113000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Drop label column from email_setting';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE email_setting DROP label');
    }

    public function down(Schema $schema): void
    {
        $this->addSql("ALTER TABLE email_setting ADD label VARCHAR(255) DEFAULT '' NOT NULL");
    }
}
