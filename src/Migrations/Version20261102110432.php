<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261102110432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename user name fields while preserving existing usernames';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user CHANGE username first_name VARCHAR(255) NOT NULL, CHANGE lastname last_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user CHANGE first_name username VARCHAR(255) NOT NULL, CHANGE last_name lastname VARCHAR(255) NOT NULL');
    }
}
