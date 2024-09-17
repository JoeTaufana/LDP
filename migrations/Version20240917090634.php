<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240917090634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, rdv DATETIME NOT NULL, prix NUMERIC(5, 2) NOT NULL, adresse VARCHAR(255) NOT NULL, file VARCHAR(255) DEFAULT NULL, INDEX IDX_B26681E73A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_evenement (evenement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BC6E5FAFD02F13 (evenement_id), INDEX IDX_BC6E5FAA76ED395 (user_id), PRIMARY KEY(evenement_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E73A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_evenement ADD CONSTRAINT FK_BC6E5FAFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_evenement ADD CONSTRAINT FK_BC6E5FAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenements DROP FOREIGN KEY FK_E10AD40073A201E5');
        $this->addSql('ALTER TABLE user_evenements DROP FOREIGN KEY FK_466D12EC63C02CD4');
        $this->addSql('ALTER TABLE user_evenements DROP FOREIGN KEY FK_466D12ECA76ED395');
        $this->addSql('DROP TABLE evenements');
        $this->addSql('DROP TABLE user_evenements');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rdv DATETIME NOT NULL, prix NUMERIC(5, 2) NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E10AD40073A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_evenements (evenements_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_466D12EC63C02CD4 (evenements_id), INDEX IDX_466D12ECA76ED395 (user_id), PRIMARY KEY(evenements_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_E10AD40073A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_evenements ADD CONSTRAINT FK_466D12EC63C02CD4 FOREIGN KEY (evenements_id) REFERENCES evenements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_evenements ADD CONSTRAINT FK_466D12ECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E73A201E5');
        $this->addSql('ALTER TABLE user_evenement DROP FOREIGN KEY FK_BC6E5FAFD02F13');
        $this->addSql('ALTER TABLE user_evenement DROP FOREIGN KEY FK_BC6E5FAA76ED395');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE user_evenement');
    }
}
