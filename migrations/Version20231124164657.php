<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124164657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entertainment_product (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entertainment_product_movie (entertainment_product_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_FE52252C9FC55C04 (entertainment_product_id), INDEX IDX_FE52252C8F93B6FC (movie_id), PRIMARY KEY(entertainment_product_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entertainment_product_series (entertainment_product_id INT NOT NULL, series_id INT NOT NULL, INDEX IDX_D5261DD09FC55C04 (entertainment_product_id), INDEX IDX_D5261DD05278319C (series_id), PRIMARY KEY(entertainment_product_id, series_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, genry_id INT NOT NULL, genre_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1D5EF26F58593B38 (genry_id), INDEX IDX_1D5EF26F4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series (id INT AUTO_INCREMENT NOT NULL, genre_id INT NOT NULL, name INT NOT NULL, INDEX IDX_3A10012D4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entertainment_product_movie ADD CONSTRAINT FK_FE52252C9FC55C04 FOREIGN KEY (entertainment_product_id) REFERENCES entertainment_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entertainment_product_movie ADD CONSTRAINT FK_FE52252C8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entertainment_product_series ADD CONSTRAINT FK_D5261DD09FC55C04 FOREIGN KEY (entertainment_product_id) REFERENCES entertainment_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entertainment_product_series ADD CONSTRAINT FK_D5261DD05278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F58593B38 FOREIGN KEY (genry_id) REFERENCES genries (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F4296D31F FOREIGN KEY (genre_id) REFERENCES genries (id)');
        $this->addSql('ALTER TABLE series ADD CONSTRAINT FK_3A10012D4296D31F FOREIGN KEY (genre_id) REFERENCES genries (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entertainment_product_movie DROP FOREIGN KEY FK_FE52252C9FC55C04');
        $this->addSql('ALTER TABLE entertainment_product_movie DROP FOREIGN KEY FK_FE52252C8F93B6FC');
        $this->addSql('ALTER TABLE entertainment_product_series DROP FOREIGN KEY FK_D5261DD09FC55C04');
        $this->addSql('ALTER TABLE entertainment_product_series DROP FOREIGN KEY FK_D5261DD05278319C');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F58593B38');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F4296D31F');
        $this->addSql('ALTER TABLE series DROP FOREIGN KEY FK_3A10012D4296D31F');
        $this->addSql('DROP TABLE entertainment_product');
        $this->addSql('DROP TABLE entertainment_product_movie');
        $this->addSql('DROP TABLE entertainment_product_series');
        $this->addSql('DROP TABLE genries');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE series');
    }
}