<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919131504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB560438603E7260 FOREIGN KEY (first_step_id) REFERENCES step (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB560438603E7260 ON story (first_step_id)');
        $this->addSql('ALTER TABLE user DROP last_step');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB560438603E7260');
        $this->addSql('DROP INDEX UNIQ_EB560438603E7260 ON story');
        $this->addSql('ALTER TABLE user ADD last_step INT NOT NULL');
    }
}
