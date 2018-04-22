<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Recipe and Ingredient tables/relations
 */
class Version20180421184018 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, preparation LONGTEXT NOT NULL, cooking_steps LONGTEXT NOT NULL, description LONGTEXT NOT NULL, duration VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_DA88B137FCFA9DAE (difficulty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, note LONGTEXT DEFAULT NULL, quantity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_recipe (ingredient_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_36F27176933FE08C (ingredient_id), INDEX IDX_36F2717659D8A214 (recipe_id), PRIMARY KEY(ingredient_id, recipe_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F2717659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137FCFA9DAE');
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F2717659D8A214');
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176933FE08C');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_recipe');
    }
}
