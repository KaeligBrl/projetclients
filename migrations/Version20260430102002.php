<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260430102002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE website_project (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, position INT DEFAULT NULL, customerbrief TINYINT(1) DEFAULT NULL, comingsoon TINYINT(1) DEFAULT NULL, customercontentreception TINYINT(1) DEFAULT NULL, webdesignprogress TINYINT(1) DEFAULT NULL, webdesignsend TINYINT(1) DEFAULT NULL, webdesignvalidated TINYINT(1) DEFAULT NULL, domainname TINYINT(1) DEFAULT NULL, domain_text LONGTEXT DEFAULT NULL, webintegration TINYINT(1) NOT NULL, webtraining TINYINT(1) DEFAULT NULL, online DATETIME DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, wordpress_installation DATETIME DEFAULT NULL, INDEX IDX_839DAC4A9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE website_project ADD CONSTRAINT FK_839DAC4A9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A49395C3F3');
        $this->addSql('DROP TABLE projects');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, position INT DEFAULT NULL, customerbrief TINYINT(1) DEFAULT NULL, comingsoon TINYINT(1) DEFAULT NULL, customercontentreception TINYINT(1) DEFAULT NULL, webdesignprogress TINYINT(1) DEFAULT NULL, webdesignsend TINYINT(1) DEFAULT NULL, webdesignvalidated TINYINT(1) DEFAULT NULL, domainname TINYINT(1) DEFAULT NULL, domain_text LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, webintegration TINYINT(1) NOT NULL, webtraining TINYINT(1) DEFAULT NULL, online DATETIME DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, wordpress_installation DATETIME DEFAULT NULL, INDEX IDX_5C93B3A49395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE website_project DROP FOREIGN KEY FK_839DAC4A9395C3F3');
        $this->addSql('DROP TABLE website_project');
    }
}
