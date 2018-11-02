<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181012002542 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_collection ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe_collection ADD CONSTRAINT FK_B533E351A76ED395 FOREIGN KEY (user_id) REFERENCES hungry_user (id)');
        $this->addSql('CREATE INDEX IDX_B533E351A76ED395 ON recipe_collection (user_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_collection DROP FOREIGN KEY FK_B533E351A76ED395');
        $this->addSql('DROP INDEX IDX_B533E351A76ED395 ON recipe_collection');
        $this->addSql('ALTER TABLE recipe_collection DROP user_id');
    }
}
