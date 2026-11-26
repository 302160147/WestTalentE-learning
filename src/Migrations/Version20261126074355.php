<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261126074355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE submission_answer_option (submission_id INT NOT NULL, answer_option_id INT NOT NULL, INDEX IDX_955A4AFDE1FD4933 (submission_id), INDEX IDX_955A4AFD9A3BC2B9 (answer_option_id), PRIMARY KEY (submission_id, answer_option_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE submission_answer_option ADD CONSTRAINT FK_955A4AFDE1FD4933 FOREIGN KEY (submission_id) REFERENCES submission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE submission_answer_option ADD CONSTRAINT FK_955A4AFD9A3BC2B9 FOREIGN KEY (answer_option_id) REFERENCES answer_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer_option CHANGE is_correct is_correct VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY `FK_DB055AF39A3BC2B9`');
        $this->addSql('DROP INDEX IDX_DB055AF39A3BC2B9 ON submission');
        $this->addSql('ALTER TABLE submission DROP answer_option_id, CHANGE is_correct is_correct VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE submission_answer_option DROP FOREIGN KEY FK_955A4AFDE1FD4933');
        $this->addSql('ALTER TABLE submission_answer_option DROP FOREIGN KEY FK_955A4AFD9A3BC2B9');
        $this->addSql('DROP TABLE submission_answer_option');
        $this->addSql('ALTER TABLE answer_option CHANGE is_correct is_correct INT DEFAULT NULL');
        $this->addSql('ALTER TABLE submission ADD answer_option_id INT DEFAULT NULL, CHANGE is_correct is_correct INT DEFAULT NULL');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT `FK_DB055AF39A3BC2B9` FOREIGN KEY (answer_option_id) REFERENCES answer_option (id)');
        $this->addSql('CREATE INDEX IDX_DB055AF39A3BC2B9 ON submission (answer_option_id)');
    }
}
