<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113174539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY CONTAINER_CONTAINERSHIP_ID_fk');
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY CONTAINER_CONTAINER_MODEL_ID_fk');
        $this->addSql('DROP INDEX CONTAINER_CONTAINER_MODEL_ID_fk ON container');
        $this->addSql('DROP INDEX CONTAINER_CONTAINERSHIP_ID_fk ON container');
        $this->addSql('DROP INDEX CONTAINER_ID_uindex ON container');
        $this->addSql('ALTER TABLE container CHANGE COLOR color VARCHAR(20) NOT NULL, CHANGE CONTAINER_MODEL_ID container_model_id INT NOT NULL, CHANGE CONTAINERSHIP_ID containership_id INT NOT NULL');
        $this->addSql('ALTER TABLE container_model CHANGE NAME name VARCHAR(255) NOT NULL, CHANGE LENGTH length INT NOT NULL, CHANGE WIDTH width INT NOT NULL, CHANGE HEIGHT height INT NOT NULL');
        $this->addSql('ALTER TABLE container_product DROP FOREIGN KEY CONTAINER_PRODUCT_CONTAINER_ID_fk');
        $this->addSql('ALTER TABLE container_product DROP FOREIGN KEY CONTAINER_PRODUCT_PRODUCT_ID_fk');
        $this->addSql('DROP INDEX CONTAINER_PRODUCT_CONTAINER_ID_fk ON container_product');
        $this->addSql('DROP INDEX CONTAINER_PRODUCT_PRODUCT_ID_fk ON container_product');
        $this->addSql('ALTER TABLE container_product CHANGE CONTAINER_ID container_id INT NOT NULL, CHANGE PRODUCT_ID product_id INT NOT NULL, CHANGE QUANTITY quantity INT NOT NULL');
        $this->addSql('ALTER TABLE containership CHANGE NAME name VARCHAR(255) NOT NULL, CHANGE CAPTAIN_NAME captain_name VARCHAR(255) NOT NULL, CHANGE CONTAINER_LIMIT container_limit INT NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE NAME name VARCHAR(255) NOT NULL, CHANGE LENGTH length INT NOT NULL, CHANGE WIDTH width INT NOT NULL, CHANGE HEIGHT height INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE container CHANGE color COLOR VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE container_model_id CONTAINER_MODEL_ID INT DEFAULT NULL, CHANGE containership_id CONTAINERSHIP_ID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT CONTAINER_CONTAINERSHIP_ID_fk FOREIGN KEY (CONTAINERSHIP_ID) REFERENCES containership (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE container ADD CONSTRAINT CONTAINER_CONTAINER_MODEL_ID_fk FOREIGN KEY (CONTAINER_MODEL_ID) REFERENCES container_model (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX CONTAINER_CONTAINER_MODEL_ID_fk ON container (CONTAINER_MODEL_ID)');
        $this->addSql('CREATE INDEX CONTAINER_CONTAINERSHIP_ID_fk ON container (CONTAINERSHIP_ID)');
        $this->addSql('CREATE UNIQUE INDEX CONTAINER_ID_uindex ON container (ID)');
        $this->addSql('ALTER TABLE containership CHANGE name NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE captain_name CAPTAIN_NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE container_limit CONTAINER_LIMIT INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container_model CHANGE name NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE length LENGTH INT DEFAULT NULL, CHANGE width WIDTH INT DEFAULT NULL, CHANGE height HEIGHT INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container_product CHANGE container_id CONTAINER_ID INT DEFAULT NULL, CHANGE product_id PRODUCT_ID INT DEFAULT NULL, CHANGE quantity QUANTITY INT DEFAULT NULL');
        $this->addSql('ALTER TABLE container_product ADD CONSTRAINT CONTAINER_PRODUCT_CONTAINER_ID_fk FOREIGN KEY (CONTAINER_ID) REFERENCES container (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE container_product ADD CONSTRAINT CONTAINER_PRODUCT_PRODUCT_ID_fk FOREIGN KEY (PRODUCT_ID) REFERENCES product (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX CONTAINER_PRODUCT_CONTAINER_ID_fk ON container_product (CONTAINER_ID)');
        $this->addSql('CREATE INDEX CONTAINER_PRODUCT_PRODUCT_ID_fk ON container_product (PRODUCT_ID)');
        $this->addSql('ALTER TABLE product CHANGE name NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE length LENGTH INT DEFAULT NULL, CHANGE width WIDTH INT DEFAULT NULL, CHANGE height HEIGHT INT DEFAULT NULL');
    }
}
