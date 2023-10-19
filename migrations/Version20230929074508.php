<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929074508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projection_film DROP FOREIGN KEY FK_1E93E2E3567F5183');
        $this->addSql('ALTER TABLE projection_film DROP FOREIGN KEY FK_1E93E2E35ECF66BD');
        $this->addSql('DROP TABLE projection_film');
        $this->addSql('ALTER TABLE projection ADD films_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projection ADD CONSTRAINT FK_8004C826939610EE FOREIGN KEY (films_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_8004C826939610EE ON projection (films_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projection_film (projection_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_1E93E2E3567F5183 (film_id), INDEX IDX_1E93E2E35ECF66BD (projection_id), PRIMARY KEY(projection_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE projection_film ADD CONSTRAINT FK_1E93E2E3567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projection_film ADD CONSTRAINT FK_1E93E2E35ECF66BD FOREIGN KEY (projection_id) REFERENCES projection (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projection DROP FOREIGN KEY FK_8004C826939610EE');
        $this->addSql('DROP INDEX IDX_8004C826939610EE ON projection');
        $this->addSql('ALTER TABLE projection DROP films_id');
    }
}
