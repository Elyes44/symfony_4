<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414135933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, creation_date DATE NOT NULL, prix_total DOUBLE PRECISION NOT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prod_commande (commande_id INT NOT NULL, prod_id INT NOT NULL, INDEX IDX_C0F2142A82EA2E54 (commande_id), INDEX IDX_C0F2142A1C83F75 (prod_id), PRIMARY KEY(commande_id, prod_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_creation DATE NOT NULL, state VARCHAR(255) NOT NULL, prix_total VARCHAR(255) NOT NULL, INDEX IDX_A60C9F1FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prod_commande ADD CONSTRAINT FK_C0F2142A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE prod_commande ADD CONSTRAINT FK_C0F2142A1C83F75 FOREIGN KEY (prod_id) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prod_commande DROP FOREIGN KEY FK_C0F2142A82EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FA76ED395');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE prod_commande');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE user');
    }
}
