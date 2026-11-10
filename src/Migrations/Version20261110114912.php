<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261110114912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_option ADD assignment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE answer_option ADD CONSTRAINT FK_A87F3A17D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('CREATE INDEX IDX_A87F3A17D19302F8 ON answer_option (assignment_id)');
        $this->addSql('ALTER TABLE assignment ADD lesson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assignment ADD CONSTRAINT FK_30C544BACDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('CREATE INDEX IDX_30C544BACDF80196 ON assignment (lesson_id)');
        $this->addSql('ALTER TABLE lesson ADD module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3AFC2B591 ON lesson (module_id)');
        $this->addSql('ALTER TABLE module ADD vak_id INT DEFAULT NULL, ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628BDCC7DA2 FOREIGN KEY (vak_id) REFERENCES vak (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_C242628BDCC7DA2 ON module (vak_id)');
        $this->addSql('CREATE INDEX IDX_C242628B3E9C81 ON module (niveau_id)');
        $this->addSql('ALTER TABLE studentprogress ADD module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE studentprogress ADD CONSTRAINT FK_BB7FA6C3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_BB7FA6C3AFC2B591 ON studentprogress (module_id)');
        $this->addSql('ALTER TABLE submission ADD user_id INT DEFAULT NULL, ADD assignment_id INT DEFAULT NULL, ADD answer_option_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF3D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF39A3BC2B9 FOREIGN KEY (answer_option_id) REFERENCES answer_option (id)');
        $this->addSql('CREATE INDEX IDX_DB055AF3A76ED395 ON submission (user_id)');
        $this->addSql('CREATE INDEX IDX_DB055AF3D19302F8 ON submission (assignment_id)');
        $this->addSql('CREATE INDEX IDX_DB055AF39A3BC2B9 ON submission (answer_option_id)');
        $this->addSql('ALTER TABLE user ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A76ED395 ON user (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_option DROP FOREIGN KEY FK_A87F3A17D19302F8');
        $this->addSql('DROP INDEX IDX_A87F3A17D19302F8 ON answer_option');
        $this->addSql('ALTER TABLE answer_option DROP assignment_id');
        $this->addSql('ALTER TABLE assignment DROP FOREIGN KEY FK_30C544BACDF80196');
        $this->addSql('DROP INDEX IDX_30C544BACDF80196 ON assignment');
        $this->addSql('ALTER TABLE assignment DROP lesson_id');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3AFC2B591');
        $this->addSql('DROP INDEX IDX_F87474F3AFC2B591 ON lesson');
        $this->addSql('ALTER TABLE lesson DROP module_id');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628BDCC7DA2');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628B3E9C81');
        $this->addSql('DROP INDEX IDX_C242628BDCC7DA2 ON module');
        $this->addSql('DROP INDEX IDX_C242628B3E9C81 ON module');
        $this->addSql('ALTER TABLE module DROP vak_id, DROP niveau_id');
        $this->addSql('ALTER TABLE studentprogress DROP FOREIGN KEY FK_BB7FA6C3AFC2B591');
        $this->addSql('DROP INDEX IDX_BB7FA6C3AFC2B591 ON studentprogress');
        $this->addSql('ALTER TABLE studentprogress DROP module_id');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF3A76ED395');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF3D19302F8');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF39A3BC2B9');
        $this->addSql('DROP INDEX IDX_DB055AF3A76ED395 ON submission');
        $this->addSql('DROP INDEX IDX_DB055AF3D19302F8 ON submission');
        $this->addSql('DROP INDEX IDX_DB055AF39A3BC2B9 ON submission');
        $this->addSql('ALTER TABLE submission DROP user_id, DROP assignment_id, DROP answer_option_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A76ED395');
        $this->addSql('DROP INDEX IDX_8D93D649A76ED395 ON user');
        $this->addSql('ALTER TABLE user DROP user_id');
    }
}
