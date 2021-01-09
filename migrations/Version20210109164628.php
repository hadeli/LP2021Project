<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109164628 extends AbstractMigration
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
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE CONTAINER DROP FOREIGN KEY CONTAINER_CONTAINER_MODEL_ID_fk');
        $this->addSql('DROP INDEX CONTAINER_CONTAINER_MODEL_ID_fk ON CONTAINER');
        $this->addSql('DROP INDEX CONTAINER_CONTAINERSHIP_ID_fk ON CONTAINER');
        $this->addSql('DROP INDEX CONTAINER_ID_uindex ON CONTAINER');
        $this->addSql('ALTER TABLE CONTAINER ADD container_ship_id_id INT NOT NULL, ADD container_model_id_id INT NOT NULL, DROP CONTAINER_MODEL_ID, DROP CONTAINERSHIP_ID, CHANGE COLOR color VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE CONTAINER ADD CONSTRAINT FK_C7A2EC1B74E77CE FOREIGN KEY (container_ship_id_id) REFERENCES container_ship (id)');
        $this->addSql('ALTER TABLE CONTAINER ADD CONSTRAINT FK_C7A2EC1B3E14C0A1 FOREIGN KEY (container_model_id_id) REFERENCES container_model (id)');
        $this->addSql('CREATE INDEX IDX_C7A2EC1B74E77CE ON CONTAINER (container_ship_id_id)');
        $this->addSql('CREATE INDEX IDX_C7A2EC1B3E14C0A1 ON CONTAINER (container_model_id_id)');
        $this->addSql('ALTER TABLE CONTAINER_MODEL CHANGE NAME name VARCHAR(255) NOT NULL, CHANGE LENGTH length INT NOT NULL, CHANGE WIDTH width INT NOT NULL, CHANGE HEIGHT height INT NOT NULL');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT DROP FOREIGN KEY CONTAINER_PRODUCT_CONTAINER_ID_fk');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT DROP FOREIGN KEY CONTAINER_PRODUCT_PRODUCT_ID_fk');
        $this->addSql('DROP INDEX CONTAINER_PRODUCT_CONTAINER_ID_fk ON CONTAINER_PRODUCT');
        $this->addSql('DROP INDEX CONTAINER_PRODUCT_PRODUCT_ID_fk ON CONTAINER_PRODUCT');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT ADD container_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP CONTAINER_ID, DROP PRODUCT_ID');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT ADD CONSTRAINT FK_4D3280E02CBFB06 FOREIGN KEY (container_id_id) REFERENCES container (id)');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT ADD CONSTRAINT FK_4D3280E0DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_4D3280E02CBFB06 ON CONTAINER_PRODUCT (container_id_id)');
        $this->addSql('CREATE INDEX IDX_4D3280E0DE18E50B ON CONTAINER_PRODUCT (product_id_id)');
        $this->addSql('ALTER TABLE PRODUCT CHANGE NAME name VARCHAR(255) NOT NULL, CHANGE LENGTH length INT NOT NULL, CHANGE WIDTH width INT NOT NULL, CHANGE HEIGHT height INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1B74E77CE');
        $this->addSql('CREATE TABLE CONTAINERSHIP (ID INT AUTO_INCREMENT NOT NULL, NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CAPTAIN_NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CONTAINER_LIMIT INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'Vous voyez les bateaux qui transportent des conteneurs, c\'\'est ça\' ');
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, birth_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, isbn VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, category INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE container_ship');
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY FK_C7A2EC1B3E14C0A1');
        $this->addSql('DROP INDEX IDX_C7A2EC1B74E77CE ON container');
        $this->addSql('DROP INDEX IDX_C7A2EC1B3E14C0A1 ON container');
        $this->addSql('ALTER TABLE container ADD CONTAINER_MODEL_ID INT DEFAULT NULL, ADD CONTAINERSHIP_ID INT DEFAULT NULL, DROP container_ship_id_id, DROP container_model_id_id, CHANGE color COLOR VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT CONTAINER_CONTAINERSHIP_ID_fk FOREIGN KEY (CONTAINERSHIP_ID) REFERENCES CONTAINERSHIP (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT CONTAINER_CONTAINER_MODEL_ID_fk FOREIGN KEY (CONTAINER_MODEL_ID) REFERENCES CONTAINER_MODEL (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX CONTAINER_CONTAINER_MODEL_ID_fk ON container (CONTAINER_MODEL_ID)');
        $this->addSql('CREATE INDEX CONTAINER_CONTAINERSHIP_ID_fk ON container (CONTAINERSHIP_ID)');
        $this->addSql('CREATE UNIQUE INDEX CONTAINER_ID_uindex ON container (ID)');
        $this->addSql('ALTER TABLE container_model CHANGE name NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE length LENGTH INT DEFAULT NULL, CHANGE width WIDTH INT DEFAULT NULL, CHANGE height HEIGHT INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container_product DROP FOREIGN KEY FK_4D3280E02CBFB06');
        $this->addSql('ALTER TABLE container_product DROP FOREIGN KEY FK_4D3280E0DE18E50B');
        $this->addSql('DROP INDEX IDX_4D3280E02CBFB06 ON container_product');
        $this->addSql('DROP INDEX IDX_4D3280E0DE18E50B ON container_product');
        $this->addSql('ALTER TABLE container_product ADD CONTAINER_ID INT DEFAULT NULL, ADD PRODUCT_ID INT DEFAULT NULL, DROP container_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE container_product ADD CONSTRAINT CONTAINER_PRODUCT_CONTAINER_ID_fk FOREIGN KEY (CONTAINER_ID) REFERENCES CONTAINER (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE container_product ADD CONSTRAINT CONTAINER_PRODUCT_PRODUCT_ID_fk FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCT (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX CONTAINER_PRODUCT_CONTAINER_ID_fk ON container_product (CONTAINER_ID)');
        $this->addSql('CREATE INDEX CONTAINER_PRODUCT_PRODUCT_ID_fk ON container_product (PRODUCT_ID)');
        $this->addSql('ALTER TABLE product CHANGE name NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE length LENGTH INT DEFAULT NULL, CHANGE width WIDTH INT DEFAULT NULL, CHANGE height HEIGHT INT DEFAULT NULL');
    }
}
