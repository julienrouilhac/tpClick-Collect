<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218155916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4FD8F9C3');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D4FD8F9C3 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE produit_id_id magasin_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D20096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D20096AE3 ON commande (magasin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D20096AE3');
        $this->addSql('DROP INDEX IDX_6EEAA67D20096AE3 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE magasin_id produit_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4FD8F9C3 FOREIGN KEY (produit_id_id) REFERENCES name (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D4FD8F9C3 ON commande (produit_id_id)');
    }
}
