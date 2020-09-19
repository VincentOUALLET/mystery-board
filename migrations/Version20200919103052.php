<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919103052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_last_steps ADD story_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_last_steps ADD CONSTRAINT FK_F10EFA85AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE user_last_steps ADD CONSTRAINT FK_F10EFA85A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F10EFA85AA5D4036 ON user_last_steps (story_id)');
        $this->addSql('CREATE INDEX IDX_F10EFA85A76ED395 ON user_last_steps (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_last_steps DROP FOREIGN KEY FK_F10EFA85AA5D4036');
        $this->addSql('ALTER TABLE user_last_steps DROP FOREIGN KEY FK_F10EFA85A76ED395');
        $this->addSql('DROP INDEX IDX_F10EFA85AA5D4036 ON user_last_steps');
        $this->addSql('DROP INDEX IDX_F10EFA85A76ED395 ON user_last_steps');
        $this->addSql('ALTER TABLE user_last_steps DROP story_id, DROP user_id');
    }
}
