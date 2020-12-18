<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218141144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD magasin_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2720096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2720096AE3 ON produit (magasin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2720096AE3');
        $this->addSql('DROP INDEX IDX_29A5EC2720096AE3 ON produit');
        $this->addSql('ALTER TABLE produit DROP magasin_id');
    }
}
