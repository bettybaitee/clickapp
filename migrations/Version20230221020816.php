<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221020816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rujukan ADD flag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rujukan ADD CONSTRAINT FK_A0798F34919FE4E5 FOREIGN KEY (flag_id) REFERENCES flag (id)');
        $this->addSql('CREATE INDEX IDX_A0798F34919FE4E5 ON rujukan (flag_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rujukan DROP FOREIGN KEY FK_A0798F34919FE4E5');
        $this->addSql('DROP INDEX IDX_A0798F34919FE4E5 ON rujukan');
        $this->addSql('ALTER TABLE rujukan DROP flag_id');
    }
}
