<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103065514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coauthor_new (id INT AUTO_INCREMENT NOT NULL, book_id INT DEFAULT NULL, author_id INT DEFAULT NULL, main_author SMALLINT DEFAULT NULL, INDEX IDX_8E1BE2D616A2B381 (book_id), INDEX IDX_8E1BE2D6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coauthor_new ADD CONSTRAINT FK_8E1BE2D616A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE coauthor_new ADD CONSTRAINT FK_8E1BE2D6F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coauthor_new');
    }
}
