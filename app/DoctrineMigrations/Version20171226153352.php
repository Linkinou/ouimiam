<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171226153352 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ingredient_model (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient ADD model_id INT DEFAULT NULL, DROP name, DROP description');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78707975B7E7 FOREIGN KEY (model_id) REFERENCES ingredient_model (id)');
        $this->addSql('CREATE INDEX IDX_6BAF78707975B7E7 ON ingredient (model_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78707975B7E7');
        $this->addSql('DROP TABLE ingredient_model');
        $this->addSql('DROP INDEX IDX_6BAF78707975B7E7 ON ingredient');
        $this->addSql('ALTER TABLE ingredient ADD name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, DROP model_id');
    }
}
