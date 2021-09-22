<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922160419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE nota_curso');
        $this->addSql('DROP TABLE nota_estudiante');
        $this->addSql('ALTER TABLE nota ADD estudiante_id INT DEFAULT NULL, ADD curso_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nota ADD CONSTRAINT FK_C8D03E0D59590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id)');
        $this->addSql('ALTER TABLE nota ADD CONSTRAINT FK_C8D03E0D87CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
        $this->addSql('CREATE INDEX IDX_C8D03E0D59590C39 ON nota (estudiante_id)');
        $this->addSql('CREATE INDEX IDX_C8D03E0D87CB4A1F ON nota (curso_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nota_curso (nota_id INT NOT NULL, curso_id INT NOT NULL, INDEX IDX_5B64C72887CB4A1F (curso_id), INDEX IDX_5B64C728A98F9F02 (nota_id), PRIMARY KEY(nota_id, curso_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nota_estudiante (nota_id INT NOT NULL, estudiante_id INT NOT NULL, INDEX IDX_589E2DE259590C39 (estudiante_id), INDEX IDX_589E2DE2A98F9F02 (nota_id), PRIMARY KEY(nota_id, estudiante_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE nota_curso ADD CONSTRAINT FK_5B64C72887CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nota_curso ADD CONSTRAINT FK_5B64C728A98F9F02 FOREIGN KEY (nota_id) REFERENCES nota (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nota_estudiante ADD CONSTRAINT FK_589E2DE259590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nota_estudiante ADD CONSTRAINT FK_589E2DE2A98F9F02 FOREIGN KEY (nota_id) REFERENCES nota (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nota DROP FOREIGN KEY FK_C8D03E0D59590C39');
        $this->addSql('ALTER TABLE nota DROP FOREIGN KEY FK_C8D03E0D87CB4A1F');
        $this->addSql('DROP INDEX IDX_C8D03E0D59590C39 ON nota');
        $this->addSql('DROP INDEX IDX_C8D03E0D87CB4A1F ON nota');
        $this->addSql('ALTER TABLE nota DROP estudiante_id, DROP curso_id');
    }
}
