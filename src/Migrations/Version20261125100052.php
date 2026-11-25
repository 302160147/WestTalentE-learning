<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125100052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Assign each user to a niveau for student progress filtering.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_8D93D649B3E9C81 ON user (niveau_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B3E9C81');
        $this->addSql('DROP INDEX IDX_8D93D649B3E9C81 ON user');
        $this->addSql('ALTER TABLE user DROP niveau_id');
    }
}
