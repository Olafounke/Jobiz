<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250605104615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, job_id INT DEFAULT NULL, cover_letter LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_A45BDDC1A76ED395 (user_id), INDEX IDX_A45BDDC1BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, address LONGTEXT NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, company_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, remote_allowed TINYINT(1) NOT NULL, salary_range VARCHAR(255) NOT NULL, INDEX IDX_FBD8E0F8C54C8C93 (type_id), INDEX IDX_FBD8E0F8979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE job_category (job_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_610BBCBABE04EA9 (job_id), INDEX IDX_610BBCBA12469DE2 (category_id), PRIMARY KEY(job_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job_category ADD CONSTRAINT FK_610BBCBABE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job_category ADD CONSTRAINT FK_610BBCBA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1BE04EA9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8C54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8979B1AD6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job_category DROP FOREIGN KEY FK_610BBCBABE04EA9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE job_category DROP FOREIGN KEY FK_610BBCBA12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE application
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE company
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE job
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE job_category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
