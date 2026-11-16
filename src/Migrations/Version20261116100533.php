<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261116100533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Lesson relationships already exist in the database.';
    }

    public function up(Schema $schema): void
    {
        // lesson_id columns and foreign keys already exist.
    }

    public function down(Schema $schema): void
    {
        // Keep existing relationships intact.
    }
}