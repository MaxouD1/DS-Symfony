<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929064723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE225ECF66BD');
        $this->addSql('DROP INDEX IDX_8244BE225ECF66BD ON film');
        $this->addSql('ALTER TABLE film DROP projection_id');
        $this->addSql('ALTER TABLE projection ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projection ADD CONSTRAINT FK_8004C826567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_8004C826567F5183 ON projection (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD projection_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE225ECF66BD FOREIGN KEY (projection_id) REFERENCES projection (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8244BE225ECF66BD ON film (projection_id)');
        $this->addSql('ALTER TABLE projection DROP FOREIGN KEY FK_8004C826567F5183');
        $this->addSql('DROP INDEX IDX_8004C826567F5183 ON projection');
        $this->addSql('ALTER TABLE projection DROP film_id');
    }
}
