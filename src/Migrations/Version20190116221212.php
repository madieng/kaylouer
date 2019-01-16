<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116221212 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, appointment_at DATETIME NOT NULL, appointment_adress VARCHAR(255) NOT NULL, INDEX IDX_77E0ED58C3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ad_comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, ad_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_593EBBE8A76ED395 (user_id), INDEX IDX_593EBBE84F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, town_id INT NOT NULL, road VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, INDEX IDX_D4E6F8175E23604 (town_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ad_grade (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, ad_id INT NOT NULL, grade INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_643AF4B19395C3F3 (customer_id), INDEX IDX_643AF4B14F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey (id INT AUTO_INCREMENT NOT NULL, ad_id INT DEFAULT NULL, status_journey_id INT NOT NULL, arrival_adress_id INT NOT NULL, arrival_address_id INT NOT NULL, INDEX IDX_C816C6A24F34D596 (ad_id), INDEX IDX_C816C6A2D49A6DE9 (status_journey_id), INDEX IDX_C816C6A2308357D8 (arrival_adress_id), INDEX IDX_C816C6A2A26B1FFE (arrival_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey_driver (journey_id INT NOT NULL, driver_id INT NOT NULL, INDEX IDX_A389007FD5C9896F (journey_id), INDEX IDX_A389007FC3423909 (driver_id), PRIMARY KEY(journey_id, driver_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, vehicle_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, size INT NOT NULL, extension VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_16DB4F89A76ED395 (user_id), INDEX IDX_16DB4F89545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_journey (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE town (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, model VARCHAR(255) NOT NULL, INDEX IDX_1B80E48644F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_driver (vehicle_id INT NOT NULL, driver_id INT NOT NULL, INDEX IDX_B8B87D0A545317D1 (vehicle_id), INDEX IDX_B8B87D0AC3423909 (driver_id), PRIMARY KEY(vehicle_id, driver_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE ad_comment ADD CONSTRAINT FK_593EBBE8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ad_comment ADD CONSTRAINT FK_593EBBE84F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F8175E23604 FOREIGN KEY (town_id) REFERENCES town (id)');
        $this->addSql('ALTER TABLE ad_grade ADD CONSTRAINT FK_643AF4B19395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE ad_grade ADD CONSTRAINT FK_643AF4B14F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A24F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2D49A6DE9 FOREIGN KEY (status_journey_id) REFERENCES status_journey (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2308357D8 FOREIGN KEY (arrival_adress_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2A26B1FFE FOREIGN KEY (arrival_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE journey_driver ADD CONSTRAINT FK_A389007FD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE journey_driver ADD CONSTRAINT FK_A389007FC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE vehicle_driver ADD CONSTRAINT FK_B8B87D0A545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_driver ADD CONSTRAINT FK_B8B87D0AC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP picture');
        $this->addSql('ALTER TABLE customer DROP test_customer');
        $this->addSql('ALTER TABLE driver DROP test_driver');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad_comment DROP FOREIGN KEY FK_593EBBE84F34D596');
        $this->addSql('ALTER TABLE ad_grade DROP FOREIGN KEY FK_643AF4B14F34D596');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A24F34D596');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2308357D8');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2A26B1FFE');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48644F5D008');
        $this->addSql('ALTER TABLE journey_driver DROP FOREIGN KEY FK_A389007FD5C9896F');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2D49A6DE9');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F8175E23604');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89545317D1');
        $this->addSql('ALTER TABLE vehicle_driver DROP FOREIGN KEY FK_B8B87D0A545317D1');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE ad_comment');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE ad_grade');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE journey');
        $this->addSql('DROP TABLE journey_driver');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE status_journey');
        $this->addSql('DROP TABLE town');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE vehicle_driver');
        $this->addSql('ALTER TABLE customer ADD test_customer VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE driver ADD test_driver VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user ADD picture VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
