<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261113072934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_option (id INT AUTO_INCREMENT NOT NULL, option_text VARCHAR(255) NOT NULL, is_correct INT DEFAULT NULL, assignment_id INT DEFAULT NULL, INDEX IDX_A87F3A17D19302F8 (assignment_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE assignment (id INT AUTO_INCREMENT NOT NULL, question LONGTEXT NOT NULL, question_type VARCHAR(50) NOT NULL, lesson_id INT DEFAULT NULL, INDEX IDX_30C544BACDF80196 (lesson_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, contents LONGTEXT NOT NULL, module_id INT DEFAULT NULL, INDEX IDX_F87474F3AFC2B591 (module_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, vak_id INT DEFAULT NULL, niveau_id INT DEFAULT NULL, INDEX IDX_C242628BDCC7DA2 (vak_id), INDEX IDX_C242628B3E9C81 (niveau_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE studentprogress (id INT AUTO_INCREMENT NOT NULL, completed_lesson INT NOT NULL, total_lessons INT NOT NULL, status VARCHAR(50) NOT NULL, module_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_BB7FA6C3AFC2B591 (module_id), INDEX IDX_BB7FA6C3A76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE submission (id INT AUTO_INCREMENT NOT NULL, answer_text LONGTEXT DEFAULT NULL, is_correct INT DEFAULT NULL, feedback LONGTEXT DEFAULT NULL, submitted_at DATETIME NOT NULL, user_id INT DEFAULT NULL, assignment_id INT DEFAULT NULL, answer_option_id INT DEFAULT NULL, INDEX IDX_DB055AF3A76ED395 (user_id), INDEX IDX_DB055AF3D19302F8 (assignment_id), INDEX IDX_DB055AF39A3BC2B9 (answer_option_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, is_verified TINYINT NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE vak (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE answer_option ADD CONSTRAINT FK_A87F3A17D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('ALTER TABLE assignment ADD CONSTRAINT FK_30C544BACDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628BDCC7DA2 FOREIGN KEY (vak_id) REFERENCES vak (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE studentprogress ADD CONSTRAINT FK_BB7FA6C3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE studentprogress ADD CONSTRAINT FK_BB7FA6C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF3D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF39A3BC2B9 FOREIGN KEY (answer_option_id) REFERENCES answer_option (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_option DROP FOREIGN KEY FK_A87F3A17D19302F8');
        $this->addSql('ALTER TABLE assignment DROP FOREIGN KEY FK_30C544BACDF80196');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3AFC2B591');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628BDCC7DA2');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628B3E9C81');
        $this->addSql('ALTER TABLE studentprogress DROP FOREIGN KEY FK_BB7FA6C3AFC2B591');
        $this->addSql('ALTER TABLE studentprogress DROP FOREIGN KEY FK_BB7FA6C3A76ED395');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF3A76ED395');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF3D19302F8');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF39A3BC2B9');
        $this->addSql('DROP TABLE answer_option');
        $this->addSql('DROP TABLE assignment');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE studentprogress');
        $this->addSql('DROP TABLE submission');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vak');
    }
}
