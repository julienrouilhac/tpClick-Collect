<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218134042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit_magasin');
        $this->addSql('ALTER TABLE produit ADD magasin_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC272B2B9060 FOREIGN KEY (magasin_id_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC272B2B9060 ON produit (magasin_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_magasin (produit_id INT NOT NULL, magasin_id INT NOT NULL, INDEX IDX_9254D45E20096AE3 (magasin_id), INDEX IDX_9254D45EF347EFB (produit_id), PRIMARY KEY(produit_id, magasin_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produit_magasin ADD CONSTRAINT FK_9254D45E20096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_magasin ADD CONSTRAINT FK_9254D45EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC272B2B9060');
        $this->addSql('DROP INDEX IDX_29A5EC272B2B9060 ON produit');
        $this->addSql('ALTER TABLE produit DROP magasin_id_id');
    }
}
