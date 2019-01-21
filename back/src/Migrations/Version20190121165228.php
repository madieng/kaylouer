<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190121165228 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2308357D8');
        $this->addSql('DROP INDEX IDX_C816C6A2308357D8 ON journey');
        $this->addSql('ALTER TABLE journey CHANGE arrival_adress_id departure_address_id INT NOT NULL');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A22B1957E1 FOREIGN KEY (departure_address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_C816C6A22B1957E1 ON journey (departure_address_id)');
        $this->addSql('ALTER TABLE ad CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE appointment_adress appointment_address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ad_comment CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ad_grade ADD graded_at DATETIME DEFAULT NULL, DROP created_at, CHANGE grade grade INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad CHANGE updated_at updated_at DATETIME NOT NULL, CHANGE appointment_address appointment_adress VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE ad_comment CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ad_grade ADD created_at DATETIME NOT NULL, DROP graded_at, CHANGE grade grade INT NOT NULL');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A22B1957E1');
        $this->addSql('DROP INDEX IDX_C816C6A22B1957E1 ON journey');
        $this->addSql('ALTER TABLE journey CHANGE departure_address_id arrival_adress_id INT NOT NULL');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2308357D8 FOREIGN KEY (arrival_adress_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C816C6A2308357D8 ON journey (arrival_adress_id)');
    }
}
