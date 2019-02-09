<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190209041800 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_avatar (id INT AUTO_INCREMENT NOT NULL, updated_at DATETIME NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hungry_user ADD avatar_id INT DEFAULT NULL, DROP updated_at, DROP image');
        $this->addSql('ALTER TABLE hungry_user ADD CONSTRAINT FK_9E31B79D86383B10 FOREIGN KEY (avatar_id) REFERENCES user_avatar (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9E31B79D86383B10 ON hungry_user (avatar_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hungry_user DROP FOREIGN KEY FK_9E31B79D86383B10');
        $this->addSql('DROP TABLE user_avatar');
        $this->addSql('DROP INDEX UNIQ_9E31B79D86383B10 ON hungry_user');
        $this->addSql('ALTER TABLE hungry_user ADD updated_at DATETIME NOT NULL, ADD image VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP avatar_id');
    }
}
