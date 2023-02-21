<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220082113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flag (id INT AUTO_INCREMENT NOT NULL, nama VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rujukan (id INT AUTO_INCREMENT NOT NULL, flag_id INT DEFAULT NULL, nama VARCHAR(50) DEFAULT NULL, template LONGTEXT DEFAULT NULL, INDEX IDX_A0798F34919FE4E5 (flag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rujukan ADD CONSTRAINT FK_A0798F34919FE4E5 FOREIGN KEY (flag_id) REFERENCES flag (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rujukan DROP FOREIGN KEY FK_A0798F34919FE4E5');
        $this->addSql('DROP TABLE flag');
        $this->addSql('DROP TABLE rujukan');
    }
}
