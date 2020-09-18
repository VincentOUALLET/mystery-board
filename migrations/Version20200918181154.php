<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918181154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE step ADD choice_1 VARCHAR(255) DEFAULT NULL, ADD choice_2 VARCHAR(255) DEFAULT NULL, DROP choice1, DROP choice2');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE step ADD choice1 INT DEFAULT NULL, ADD choice2 INT DEFAULT NULL, DROP choice_1, DROP choice_2');
    }
}
