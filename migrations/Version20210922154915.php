<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922154915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, duracion INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiante (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido1 VARCHAR(255) NOT NULL, apellido2 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nota (id INT AUTO_INCREMENT NOT NULL, nota DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nota_estudiante (nota_id INT NOT NULL, estudiante_id INT NOT NULL, INDEX IDX_589E2DE2A98F9F02 (nota_id), INDEX IDX_589E2DE259590C39 (estudiante_id), PRIMARY KEY(nota_id, estudiante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nota_curso (nota_id INT NOT NULL, curso_id INT NOT NULL, INDEX IDX_5B64C728A98F9F02 (nota_id), INDEX IDX_5B64C72887CB4A1F (curso_id), PRIMARY KEY(nota_id, curso_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nota_estudiante ADD CONSTRAINT FK_589E2DE2A98F9F02 FOREIGN KEY (nota_id) REFERENCES nota (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nota_estudiante ADD CONSTRAINT FK_589E2DE259590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nota_curso ADD CONSTRAINT FK_5B64C728A98F9F02 FOREIGN KEY (nota_id) REFERENCES nota (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nota_curso ADD CONSTRAINT FK_5B64C72887CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nota_curso DROP FOREIGN KEY FK_5B64C72887CB4A1F');
        $this->addSql('ALTER TABLE nota_estudiante DROP FOREIGN KEY FK_589E2DE259590C39');
        $this->addSql('ALTER TABLE nota_estudiante DROP FOREIGN KEY FK_589E2DE2A98F9F02');
        $this->addSql('ALTER TABLE nota_curso DROP FOREIGN KEY FK_5B64C728A98F9F02');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE estudiante');
        $this->addSql('DROP TABLE nota');
        $this->addSql('DROP TABLE nota_estudiante');
        $this->addSql('DROP TABLE nota_curso');
    }
}
