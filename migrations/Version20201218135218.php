<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218135218 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC272B2B9060');
        $this->addSql('DROP INDEX IDX_29A5EC272B2B9060 ON produit');
        $this->addSql('ALTER TABLE produit ADD magasin_name_id INT NOT NULL, CHANGE magasin_id_id magasin_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2720096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC276A8458A FOREIGN KEY (magasin_name_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2720096AE3 ON produit (magasin_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC276A8458A ON produit (magasin_name_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2720096AE3');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC276A8458A');
        $this->addSql('DROP INDEX IDX_29A5EC2720096AE3 ON produit');
        $this->addSql('DROP INDEX IDX_29A5EC276A8458A ON produit');
        $this->addSql('ALTER TABLE produit ADD magasin_id_id INT NOT NULL, DROP magasin_id, DROP magasin_name_id');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC272B2B9060 FOREIGN KEY (magasin_id_id) REFERENCES magasin (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29A5EC272B2B9060 ON produit (magasin_id_id)');
    }
}
