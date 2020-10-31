<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200927202755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, story_id INT NOT NULL, description LONGTEXT NOT NULL, label_choice_1 LONGTEXT DEFAULT NULL, label_choice_2 LONGTEXT DEFAULT NULL, custom_id VARCHAR(255) NOT NULL, choice_1 VARCHAR(255) DEFAULT NULL, choice_2 VARCHAR(255) DEFAULT NULL, INDEX IDX_43B9FE3CAA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, first_step_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_EB560438603E7260 (first_step_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_last_steps (id INT AUTO_INCREMENT NOT NULL, last_step_id INT DEFAULT NULL, story_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F10EFA85153E22D4 (last_step_id), INDEX IDX_F10EFA85AA5D4036 (story_id), INDEX IDX_F10EFA85A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3CAA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB560438603E7260 FOREIGN KEY (first_step_id) REFERENCES step (id)');
        $this->addSql('ALTER TABLE user_last_steps ADD CONSTRAINT FK_F10EFA85153E22D4 FOREIGN KEY (last_step_id) REFERENCES step (id)');
        $this->addSql('ALTER TABLE user_last_steps ADD CONSTRAINT FK_F10EFA85AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE user_last_steps ADD CONSTRAINT FK_F10EFA85A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB560438603E7260');
        $this->addSql('ALTER TABLE user_last_steps DROP FOREIGN KEY FK_F10EFA85153E22D4');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3CAA5D4036');
        $this->addSql('ALTER TABLE user_last_steps DROP FOREIGN KEY FK_F10EFA85AA5D4036');
        $this->addSql('ALTER TABLE user_last_steps DROP FOREIGN KEY FK_F10EFA85A76ED395');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_last_steps');
    }
}
