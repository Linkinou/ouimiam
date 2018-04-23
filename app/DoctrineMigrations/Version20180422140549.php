<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180422140549 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipe_recipe_collection (recipe_id INT NOT NULL, recipe_collection_id INT NOT NULL, INDEX IDX_677A0BF559D8A214 (recipe_id), INDEX IDX_677A0BF5C1BC403B (recipe_collection_id), PRIMARY KEY(recipe_id, recipe_collection_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_collection (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_recipe_collection ADD CONSTRAINT FK_677A0BF559D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_recipe_collection ADD CONSTRAINT FK_677A0BF5C1BC403B FOREIGN KEY (recipe_collection_id) REFERENCES recipe_collection (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe_recipe_collection DROP FOREIGN KEY FK_677A0BF5C1BC403B');
        $this->addSql('DROP TABLE recipe_recipe_collection');
        $this->addSql('DROP TABLE recipe_collection');
    }
}
