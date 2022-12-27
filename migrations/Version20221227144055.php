<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227144055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A76ED395');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A21214B7');
        $this->addSql('DROP INDEX IDX_F65593E5A21214B7 ON annonce');
        $this->addSql('DROP INDEX IDX_F65593E5A76ED395 ON annonce');
        $this->addSql('ALTER TABLE annonce ADD user_related_id INT DEFAULT NULL, DROP user_id, DROP categories_id');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5E60506ED FOREIGN KEY (user_related_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5E60506ED ON annonce (user_related_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5E60506ED');
        $this->addSql('DROP INDEX IDX_F65593E5E60506ED ON annonce');
        $this->addSql('ALTER TABLE annonce ADD categories_id INT DEFAULT NULL, CHANGE user_related_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5A21214B7 ON annonce (categories_id)');
        $this->addSql('CREATE INDEX IDX_F65593E5A76ED395 ON annonce (user_id)');
    }
}
