<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109123953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_produits (category_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_9575BF712469DE2 (category_id), INDEX IDX_9575BF7CD11A2CF (produits_id), PRIMARY KEY(category_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_produits ADD CONSTRAINT FK_9575BF712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_produits ADD CONSTRAINT FK_9575BF7CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_produits DROP FOREIGN KEY FK_9575BF712469DE2');
        $this->addSql('ALTER TABLE category_produits DROP FOREIGN KEY FK_9575BF7CD11A2CF');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_produits');
    }
}
