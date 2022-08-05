<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220805121702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sirop (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sirop_ingredient (sirop_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_4BF2DEA1F664B0C4 (sirop_id), INDEX IDX_4BF2DEA1933FE08C (ingredient_id), PRIMARY KEY(sirop_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sirop_image (id INT AUTO_INCREMENT NOT NULL, sirop_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E4846AABF664B0C4 (sirop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sirop_ingredient ADD CONSTRAINT FK_4BF2DEA1F664B0C4 FOREIGN KEY (sirop_id) REFERENCES sirop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sirop_ingredient ADD CONSTRAINT FK_4BF2DEA1933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sirop_image ADD CONSTRAINT FK_E4846AABF664B0C4 FOREIGN KEY (sirop_id) REFERENCES sirop (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sirop_ingredient DROP FOREIGN KEY FK_4BF2DEA1933FE08C');
        $this->addSql('ALTER TABLE sirop_ingredient DROP FOREIGN KEY FK_4BF2DEA1F664B0C4');
        $this->addSql('ALTER TABLE sirop_image DROP FOREIGN KEY FK_E4846AABF664B0C4');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE sirop');
        $this->addSql('DROP TABLE sirop_ingredient');
        $this->addSql('DROP TABLE sirop_image');
    }
}
