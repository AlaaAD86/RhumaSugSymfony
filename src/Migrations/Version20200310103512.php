<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310103512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comm_prod (id INT AUTO_INCREMENT NOT NULL, comm_id INT DEFAULT NULL, prod_id INT DEFAULT NULL, quantity INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_FA94BCE8EF7EB489 (comm_id), INDEX IDX_FA94BCE81C83F75 (prod_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE8EF7EB489 FOREIGN KEY (comm_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE comm_prod ADD CONSTRAINT FK_FA94BCE81C83F75 FOREIGN KEY (prod_id) REFERENCES produits (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comm_prod');
    }
}
