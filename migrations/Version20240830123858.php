<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830123858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts ADD createur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_3340157373A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3340157373A201E5 ON contacts (createur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_3340157373A201E5');
        $this->addSql('DROP INDEX IDX_3340157373A201E5 ON contacts');
        $this->addSql('ALTER TABLE contacts DROP createur_id');
    }
}
