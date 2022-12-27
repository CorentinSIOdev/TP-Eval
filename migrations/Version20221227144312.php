<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227144312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce ADD categorie_related_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5DFAB0AAD FOREIGN KEY (categorie_related_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5DFAB0AAD ON annonce (categorie_related_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5DFAB0AAD');
        $this->addSql('DROP INDEX IDX_F65593E5DFAB0AAD ON annonce');
        $this->addSql('ALTER TABLE annonce DROP categorie_related_id');
    }
}
