<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260430090240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filter_enterprise (id INT AUTO_INCREMENT NOT NULL, name_enterprise_type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filters_activities (id INT AUTO_INCREMENT NOT NULL, name_activities VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filters_websites (id INT AUTO_INCREMENT NOT NULL, name_websites VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_projects (id INT AUTO_INCREMENT NOT NULL, enterprise VARCHAR(255) NOT NULL, domain_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_projects_filters_activities (listing_projects_id INT NOT NULL, filters_activities_id INT NOT NULL, INDEX IDX_C1C9830F49C0D607 (listing_projects_id), INDEX IDX_C1C9830FD6276D3E (filters_activities_id), PRIMARY KEY(listing_projects_id, filters_activities_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_projects_filters_websites (listing_projects_id INT NOT NULL, filters_websites_id INT NOT NULL, INDEX IDX_87CB41449C0D607 (listing_projects_id), INDEX IDX_87CB414620B0B12 (filters_websites_id), PRIMARY KEY(listing_projects_id, filters_websites_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_projects_filter_enterprise (listing_projects_id INT NOT NULL, filter_enterprise_id INT NOT NULL, INDEX IDX_F957A68D49C0D607 (listing_projects_id), INDEX IDX_F957A68DC7E7B1C4 (filter_enterprise_id), PRIMARY KEY(listing_projects_id, filter_enterprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE listing_projects_filter_enterprise_type (listing_projects_id INT NOT NULL, filter_enterprise_id INT NOT NULL, INDEX IDX_5C00770949C0D607 (listing_projects_id), INDEX IDX_5C007709C7E7B1C4 (filter_enterprise_id), PRIMARY KEY(listing_projects_id, filter_enterprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, position INT DEFAULT NULL, customerbrief TINYINT(1) DEFAULT NULL, comingsoon TINYINT(1) DEFAULT NULL, customercontentreception TINYINT(1) DEFAULT NULL, webdesignprogress TINYINT(1) DEFAULT NULL, webdesignsend TINYINT(1) DEFAULT NULL, webdesignvalidated TINYINT(1) DEFAULT NULL, domainname TINYINT(1) DEFAULT NULL, domain_text LONGTEXT DEFAULT NULL, webintegration TINYINT(1) NOT NULL, webtraining TINYINT(1) DEFAULT NULL, online DATETIME DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, wordpress_installation DATETIME DEFAULT NULL, INDEX IDX_5C93B3A49395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing_projects_filters_activities ADD CONSTRAINT FK_C1C9830F49C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters_activities ADD CONSTRAINT FK_C1C9830FD6276D3E FOREIGN KEY (filters_activities_id) REFERENCES filters_activities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters_websites ADD CONSTRAINT FK_87CB41449C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filters_websites ADD CONSTRAINT FK_87CB414620B0B12 FOREIGN KEY (filters_websites_id) REFERENCES filters_websites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise ADD CONSTRAINT FK_F957A68D49C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise ADD CONSTRAINT FK_F957A68DC7E7B1C4 FOREIGN KEY (filter_enterprise_id) REFERENCES filter_enterprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise_type ADD CONSTRAINT FK_5C00770949C0D607 FOREIGN KEY (listing_projects_id) REFERENCES listing_projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise_type ADD CONSTRAINT FK_5C007709C7E7B1C4 FOREIGN KEY (filter_enterprise_id) REFERENCES filter_enterprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing_projects_filters_activities DROP FOREIGN KEY FK_C1C9830F49C0D607');
        $this->addSql('ALTER TABLE listing_projects_filters_activities DROP FOREIGN KEY FK_C1C9830FD6276D3E');
        $this->addSql('ALTER TABLE listing_projects_filters_websites DROP FOREIGN KEY FK_87CB41449C0D607');
        $this->addSql('ALTER TABLE listing_projects_filters_websites DROP FOREIGN KEY FK_87CB414620B0B12');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise DROP FOREIGN KEY FK_F957A68D49C0D607');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise DROP FOREIGN KEY FK_F957A68DC7E7B1C4');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise_type DROP FOREIGN KEY FK_5C00770949C0D607');
        $this->addSql('ALTER TABLE listing_projects_filter_enterprise_type DROP FOREIGN KEY FK_5C007709C7E7B1C4');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A49395C3F3');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE filter_enterprise');
        $this->addSql('DROP TABLE filters_activities');
        $this->addSql('DROP TABLE filters_websites');
        $this->addSql('DROP TABLE listing_projects');
        $this->addSql('DROP TABLE listing_projects_filters_activities');
        $this->addSql('DROP TABLE listing_projects_filters_websites');
        $this->addSql('DROP TABLE listing_projects_filter_enterprise');
        $this->addSql('DROP TABLE listing_projects_filter_enterprise_type');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
