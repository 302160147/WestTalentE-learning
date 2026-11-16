<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261116074720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE studentprogress ADD lesson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE studentprogress ADD CONSTRAINT FK_BB7FA6C3CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('CREATE INDEX IDX_BB7FA6C3CDF80196 ON studentprogress (lesson_id)');
        $this->addSql('ALTER TABLE submission ADD lesson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF3CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('CREATE INDEX IDX_DB055AF3CDF80196 ON submission (lesson_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE studentprogress DROP FOREIGN KEY FK_BB7FA6C3CDF80196');
        $this->addSql('DROP INDEX IDX_BB7FA6C3CDF80196 ON studentprogress');
        $this->addSql('ALTER TABLE studentprogress DROP lesson_id');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF3CDF80196');
        $this->addSql('DROP INDEX IDX_DB055AF3CDF80196 ON submission');
        $this->addSql('ALTER TABLE submission DROP lesson_id');
    }
}
