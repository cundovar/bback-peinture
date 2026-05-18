<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260518233000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create front API tables with historical prefix_* names.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE prefix_categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefix_theme (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefix_page_accueil (id INT AUTO_INCREMENT NOT NULL, texte VARCHAR(500) DEFAULT NULL, img1 VARCHAR(255) DEFAULT NULL, img2 VARCHAR(255) DEFAULT NULL, img3 VARCHAR(255) DEFAULT NULL, img4 VARCHAR(255) DEFAULT NULL, img5 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefix_oeuvre (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, theme_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_5E5FC0F9BCF5E72D (categorie_id), INDEX IDX_5E5FC0F959027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefix_like (id INT AUTO_INCREMENT NOT NULL, oeuvre_id INT DEFAULT NULL, count INT DEFAULT NULL, ip VARCHAR(255) DEFAULT NULL, INDEX IDX_A9529A4288194DE8 (oeuvre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prefix_oeuvre ADD CONSTRAINT FK_9D7D1B6EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES prefix_categorie (id)');
        $this->addSql('ALTER TABLE prefix_oeuvre ADD CONSTRAINT FK_9D7D1B6E59027487 FOREIGN KEY (theme_id) REFERENCES prefix_theme (id)');
        $this->addSql('ALTER TABLE prefix_like ADD CONSTRAINT FK_C8FD915B2C5A028 FOREIGN KEY (oeuvre_id) REFERENCES prefix_oeuvre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE prefix_like DROP FOREIGN KEY FK_C8FD915B2C5A028');
        $this->addSql('ALTER TABLE prefix_oeuvre DROP FOREIGN KEY FK_9D7D1B6EBCF5E72D');
        $this->addSql('ALTER TABLE prefix_oeuvre DROP FOREIGN KEY FK_9D7D1B6E59027487');
        $this->addSql('DROP TABLE prefix_like');
        $this->addSql('DROP TABLE prefix_oeuvre');
        $this->addSql('DROP TABLE prefix_page_accueil');
        $this->addSql('DROP TABLE prefix_theme');
        $this->addSql('DROP TABLE prefix_categorie');
    }
}
