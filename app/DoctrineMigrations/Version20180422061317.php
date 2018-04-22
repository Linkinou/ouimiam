<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Adding relations between Ingredient, BaseIngredient and Unit
 */
class Version20180422061317 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredient ADD base_ingredient_id INT DEFAULT NULL, ADD unit_id INT DEFAULT NULL, DROP name');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78701B84D535 FOREIGN KEY (base_ingredient_id) REFERENCES base_ingredient (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('CREATE INDEX IDX_6BAF78701B84D535 ON ingredient (base_ingredient_id)');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78701B84D535');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870F8BD700D');
        $this->addSql('DROP INDEX IDX_6BAF78701B84D535 ON ingredient');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D ON ingredient');
        $this->addSql('ALTER TABLE ingredient ADD name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP base_ingredient_id, DROP unit_id');
    }
}
