<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115114100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX container_container_model_id_fk ON container (container_model_id)');
        $this->addSql('CREATE INDEX container_containership_id_fk ON container (containership_id)');
        $this->addSql('CREATE INDEX container_product_product_id_fk ON container_product (product_id)');
        $this->addSql('CREATE INDEX container_product_container_id_fk ON container_product (container_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX container_container_model_id_fk ON container');
        $this->addSql('DROP INDEX container_containership_id_fk ON container');
        $this->addSql('DROP INDEX container_product_product_id_fk ON container_product');
        $this->addSql('DROP INDEX container_product_container_id_fk ON container_product');
    }
}
