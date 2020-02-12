<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200131003443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur ADD part_id INT NOT NULL, ADD partenaires_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B398DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B34CE34BEC FOREIGN KEY (part_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B338898CF5 FOREIGN KEY (partenaires_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B398DE13AC ON utilisateur (partenaire_id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B34CE34BEC ON utilisateur (part_id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B338898CF5 ON utilisateur (partenaires_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B398DE13AC');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B34CE34BEC');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B338898CF5');
        $this->addSql('DROP INDEX IDX_1D1C63B398DE13AC ON utilisateur');
        $this->addSql('DROP INDEX IDX_1D1C63B34CE34BEC ON utilisateur');
        $this->addSql('DROP INDEX IDX_1D1C63B338898CF5 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP part_id, DROP partenaires_id');
    }
}
