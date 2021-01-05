<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201106203549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE CONTAINER DROP FOREIGN KEY CONTAINER_CONTAINERSHIP_ID_fk');
        $this->addSql('CREATE TABLE container_ship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, captain_name VARCHAR(255) NOT NULL, container_limit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE CONTAINERSHIP');
        $this->addSql('DROP INDEX CONTAINER_CONTAINERSHIP_ID_fk ON CONTAINER');
        $this->addSql('DROP INDEX CONTAINER_ID_uindex ON CONTAINER');
        $this->addSql('ALTER TABLE CONTAINER ADD container_ship_id INT NOT NULL, DROP CONTAINERSHIP_ID, CHANGE COLOR color VARCHAR(20) NOT NULL, CHANGE CONTAINER_MODEL_ID container_model_id INT NOT NULL');
        $this->addSql('ALTER TABLE CONTAINER ADD CONSTRAINT FK_C7A2EC1B5C2EB530 FOREIGN KEY (container_ship_id) REFERENCES container_ship (id)');
        $this->addSql('CREATE INDEX IDX_C7A2EC1B5C2EB530 ON CONTAINER (container_ship_id)');
        $this->addSql('ALTER TABLE CONTAINER RENAME INDEX container_container_model_id_fk TO IDX_C7A2EC1B7186F24E');
        $this->addSql('ALTER TABLE CONTAINER_MODEL CHANGE NAME name VARCHAR(255) NOT NULL, CHANGE LENGTH length INT NOT NULL, CHANGE WIDTH width INT NOT NULL, CHANGE HEIGHT height INT NOT NULL');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT CHANGE CONTAINER_ID container_id INT NOT NULL, CHANGE PRODUCT_ID product_id INT NOT NULL, CHANGE QUANTITY quantity INT NOT NULL');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT RENAME INDEX container_product_container_id_fk TO IDX_4D3280E0BC21F742');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT RENAME INDEX container_product_product_id_fk TO IDX_4D3280E04584665A');
        $this->addSql('ALTER TABLE PRODUCT CHANGE NAME name VARCHAR(255) NOT NULL, CHANGE LENGTH length INT NOT NULL, CHANGE WIDTH width INT NOT NULL, CHANGE HEIGHT height INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1B5C2EB530');
        $this->addSql('CREATE TABLE CONTAINERSHIP (ID INT AUTO_INCREMENT NOT NULL, NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CAPTAIN_NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CONTAINER_LIMIT INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'Vous voyez les bateaux qui transportent des conteneurs, c\'\'est ça\' ');
        $this->addSql('DROP TABLE container_ship');
        $this->addSql('DROP INDEX IDX_C7A2EC1B5C2EB530 ON container');
        $this->addSql('ALTER TABLE container ADD CONTAINERSHIP_ID INT DEFAULT NULL, DROP container_ship_id, CHANGE container_model_id CONTAINER_MODEL_ID INT DEFAULT NULL, CHANGE color COLOR VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT CONTAINER_CONTAINERSHIP_ID_fk FOREIGN KEY (CONTAINERSHIP_ID) REFERENCES CONTAINERSHIP (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX CONTAINER_CONTAINERSHIP_ID_fk ON container (CONTAINERSHIP_ID)');
        $this->addSql('CREATE UNIQUE INDEX CONTAINER_ID_uindex ON container (ID)');
        $this->addSql('ALTER TABLE container RENAME INDEX idx_c7a2ec1b7186f24e TO CONTAINER_CONTAINER_MODEL_ID_fk');
        $this->addSql('ALTER TABLE container_model CHANGE name NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE length LENGTH INT DEFAULT NULL, CHANGE width WIDTH INT DEFAULT NULL, CHANGE height HEIGHT INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container_product CHANGE container_id CONTAINER_ID INT DEFAULT NULL, CHANGE product_id PRODUCT_ID INT DEFAULT NULL, CHANGE quantity QUANTITY INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container_product RENAME INDEX idx_4d3280e0bc21f742 TO CONTAINER_PRODUCT_CONTAINER_ID_fk');
        $this->addSql('ALTER TABLE container_product RENAME INDEX idx_4d3280e04584665a TO CONTAINER_PRODUCT_PRODUCT_ID_fk');
        $this->addSql('ALTER TABLE product CHANGE name NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE length LENGTH INT DEFAULT NULL, CHANGE width WIDTH INT DEFAULT NULL, CHANGE height HEIGHT INT DEFAULT NULL');
    }
}
