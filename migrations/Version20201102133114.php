<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102133114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_ending_steps_records (id INT AUTO_INCREMENT NOT NULL, story_id INT NOT NULL, user_id INT NOT NULL, step_id INT NOT NULL, INDEX IDX_B6B9EA00AA5D4036 (story_id), INDEX IDX_B6B9EA00A76ED395 (user_id), INDEX IDX_B6B9EA0073B21E9C (step_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_ending_steps_records ADD CONSTRAINT FK_B6B9EA00AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE user_ending_steps_records ADD CONSTRAINT FK_B6B9EA00A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_ending_steps_records ADD CONSTRAINT FK_B6B9EA0073B21E9C FOREIGN KEY (step_id) REFERENCES step (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_ending_steps_records');
    }
}
