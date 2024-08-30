<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830074411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_evenements (evenements_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_466D12EC63C02CD4 (evenements_id), INDEX IDX_466D12ECA76ED395 (user_id), PRIMARY KEY(evenements_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_evenements ADD CONSTRAINT FK_466D12EC63C02CD4 FOREIGN KEY (evenements_id) REFERENCES evenements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_evenements ADD CONSTRAINT FK_466D12ECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168A76ED395 ON articles (user_id)');
        $this->addSql('ALTER TABLE evenements ADD createur_id INT NOT NULL');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD40073A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E10AD40073A201E5 ON evenements (createur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_evenements DROP FOREIGN KEY FK_466D12EC63C02CD4');
        $this->addSql('ALTER TABLE user_evenements DROP FOREIGN KEY FK_466D12ECA76ED395');
        $this->addSql('DROP TABLE user_evenements');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A76ED395');
        $this->addSql('DROP INDEX IDX_BFDD3168A76ED395 ON articles');
        $this->addSql('ALTER TABLE articles DROP user_id');
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD40073A201E5');
        $this->addSql('DROP INDEX IDX_E10AD40073A201E5 ON evenements');
        $this->addSql('ALTER TABLE evenements DROP createur_id');
    }
}
