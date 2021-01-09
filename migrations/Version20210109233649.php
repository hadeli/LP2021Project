<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109233649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author_book DROP FOREIGN KEY author_book_author_id_fk');
        $this->addSql('ALTER TABLE author_book DROP FOREIGN KEY author_book_book_id_fk');
        $this->addSql('ALTER TABLE book_library DROP FOREIGN KEY book_library_book_id_fk');
        $this->addSql('ALTER TABLE user_book_library DROP FOREIGN KEY user_book_library_book_library_id_fk');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY book_category_id_fk');
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY CONTAINER_CONTAINERSHIP_ID_fk');
        $this->addSql('ALTER TABLE book_library DROP FOREIGN KEY book_library_library_id_fk');
        $this->addSql('ALTER TABLE user_book_library DROP FOREIGN KEY user_book_library_user_id_fk');
        $this->addSql('CREATE TABLE CONTAINERSHIP (ID INT AUTO_INCREMENT NOT NULL, NAME VARCHAR(255) DEFAULT NULL, CAPTAIN_NAME VARCHAR(255) DEFAULT NULL, CONTAINER_LIMIT INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE author_book');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_library');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE container_ship');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_book_library');
        $this->addSql('ALTER TABLE container DROP FOREIGN KEY CONTAINER_CONTAINER_MODEL_ID_fk');
        $this->addSql('DROP INDEX CONTAINER_CONTAINER_MODEL_ID_fk ON container');
        $this->addSql('DROP INDEX CONTAINER_CONTAINERSHIP_ID_fk ON container');
        $this->addSql('DROP INDEX CONTAINER_ID_uindex ON container');
        $this->addSql('ALTER TABLE container_product DROP FOREIGN KEY CONTAINER_PRODUCT_CONTAINER_ID_fk');
        $this->addSql('ALTER TABLE container_product DROP FOREIGN KEY CONTAINER_PRODUCT_PRODUCT_ID_fk');
        $this->addSql('DROP INDEX CONTAINER_PRODUCT_CONTAINER_ID_fk ON container_product');
        $this->addSql('DROP INDEX CONTAINER_PRODUCT_PRODUCT_ID_fk ON container_product');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, birth_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE author_book (id INT AUTO_INCREMENT NOT NULL, book INT DEFAULT NULL, author INT DEFAULT NULL, INDEX author_book_author_id_fk (author), UNIQUE INDEX author_book_book_author_uniq_index (book, author), INDEX IDX_2F0A2BEECBE5A331 (book), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, category INT DEFAULT NULL, label VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, isbn VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX book_category_id_fk (category), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE book_library (id INT AUTO_INCREMENT NOT NULL, book INT DEFAULT NULL, library INT DEFAULT NULL, INDEX book_library_book_id_fk (book), INDEX book_library_library_id_fk (library), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE container_ship (ID INT AUTO_INCREMENT NOT NULL, NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CAPTAIN_NAME VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CONTAINER_LIMIT INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'Vous voyez les bateaux qui transportent des conteneurs, c\'\'est ça\' ');
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_book_library (id INT AUTO_INCREMENT NOT NULL, book_library INT NOT NULL, user INT NOT NULL, start DATE NOT NULL, end DATE DEFAULT NULL, INDEX user_book_library_book_library_id_fk (book_library), INDEX user_book_library_user_id_fk (user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE author_book ADD CONSTRAINT author_book_author_id_fk FOREIGN KEY (author) REFERENCES author (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE author_book ADD CONSTRAINT author_book_book_id_fk FOREIGN KEY (book) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT book_category_id_fk FOREIGN KEY (category) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE book_library ADD CONSTRAINT book_library_book_id_fk FOREIGN KEY (book) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE book_library ADD CONSTRAINT book_library_library_id_fk FOREIGN KEY (library) REFERENCES library (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_book_library ADD CONSTRAINT user_book_library_book_library_id_fk FOREIGN KEY (book_library) REFERENCES book_library (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_book_library ADD CONSTRAINT user_book_library_user_id_fk FOREIGN KEY (user) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE CONTAINERSHIP');
        $this->addSql('ALTER TABLE CONTAINER ADD CONSTRAINT CONTAINER_CONTAINERSHIP_ID_fk FOREIGN KEY (CONTAINERSHIP_ID) REFERENCES container_ship (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE CONTAINER ADD CONSTRAINT CONTAINER_CONTAINER_MODEL_ID_fk FOREIGN KEY (CONTAINER_MODEL_ID) REFERENCES container_model (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX CONTAINER_CONTAINER_MODEL_ID_fk ON CONTAINER (CONTAINER_MODEL_ID)');
        $this->addSql('CREATE INDEX CONTAINER_CONTAINERSHIP_ID_fk ON CONTAINER (CONTAINERSHIP_ID)');
        $this->addSql('CREATE UNIQUE INDEX CONTAINER_ID_uindex ON CONTAINER (ID)');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT ADD CONSTRAINT CONTAINER_PRODUCT_CONTAINER_ID_fk FOREIGN KEY (CONTAINER_ID) REFERENCES container (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE CONTAINER_PRODUCT ADD CONSTRAINT CONTAINER_PRODUCT_PRODUCT_ID_fk FOREIGN KEY (PRODUCT_ID) REFERENCES product (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX CONTAINER_PRODUCT_CONTAINER_ID_fk ON CONTAINER_PRODUCT (CONTAINER_ID)');
        $this->addSql('CREATE INDEX CONTAINER_PRODUCT_PRODUCT_ID_fk ON CONTAINER_PRODUCT (PRODUCT_ID)');
    }
}
