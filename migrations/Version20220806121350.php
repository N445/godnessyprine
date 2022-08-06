<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806121350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sirop_ingredient DROP FOREIGN KEY FK_4BF2DEA1933FE08C');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE sirop_ingredient');
        $this->addSql('ALTER TABLE sirop ADD ingredients LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sirop_ingredient (sirop_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_4BF2DEA1F664B0C4 (sirop_id), INDEX IDX_4BF2DEA1933FE08C (ingredient_id), PRIMARY KEY(sirop_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sirop_ingredient ADD CONSTRAINT FK_4BF2DEA1F664B0C4 FOREIGN KEY (sirop_id) REFERENCES sirop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sirop_ingredient ADD CONSTRAINT FK_4BF2DEA1933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sirop DROP ingredients');
    }
}
