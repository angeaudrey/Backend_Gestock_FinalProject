<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321003539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE articles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE echange_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE proposition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE articles (id INT NOT NULL, user_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, description TEXT NOT NULL, photo VARCHAR(255) DEFAULT NULL, statut BOOLEAN DEFAULT NULL, datecreation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, montantestimation DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BFDD3168A76ED395 ON articles (user_id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168BCF5E72D ON articles (categorie_id)');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, designation VARCHAR(255) NOT NULL, display BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE echange (id INT NOT NULL, userquidemande_id INT DEFAULT NULL, userquirecoit_id INT DEFAULT NULL, articledemande_id INT DEFAULT NULL, articlerecu_id INT DEFAULT NULL, identifiantproposition_id INT DEFAULT NULL, datechange TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B577E3BF4692951F ON echange (userquidemande_id)');
        $this->addSql('CREATE INDEX IDX_B577E3BF7DC6313A ON echange (userquirecoit_id)');
        $this->addSql('CREATE INDEX IDX_B577E3BF1740AF21 ON echange (articledemande_id)');
        $this->addSql('CREATE INDEX IDX_B577E3BF3625B187 ON echange (articlerecu_id)');
        $this->addSql('CREATE INDEX IDX_B577E3BF7695BD1A ON echange (identifiantproposition_id)');
        $this->addSql('CREATE TABLE proposition (id INT NOT NULL, userquidemande_id INT DEFAULT NULL, userquirecois_id INT DEFAULT NULL, articledemande_id INT DEFAULT NULL, articlequirecois_id INT DEFAULT NULL, articlequirecoistrue_id INT DEFAULT NULL, messsage VARCHAR(255) NOT NULL, dateproposition TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, etatproposition VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C7CDC3534692951F ON proposition (userquidemande_id)');
        $this->addSql('CREATE INDEX IDX_C7CDC353E0110983 ON proposition (userquirecois_id)');
        $this->addSql('CREATE INDEX IDX_C7CDC3531740AF21 ON proposition (articledemande_id)');
        $this->addSql('CREATE INDEX IDX_C7CDC353D389AA71 ON proposition (articlequirecois_id)');
        $this->addSql('CREATE INDEX IDX_C7CDC353BF605A20 ON proposition (articlequirecoistrue_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168BCF5E72D FOREIGN KEY (categorie_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF4692951F FOREIGN KEY (userquidemande_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF7DC6313A FOREIGN KEY (userquirecoit_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF1740AF21 FOREIGN KEY (articledemande_id) REFERENCES articles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF3625B187 FOREIGN KEY (articlerecu_id) REFERENCES articles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF7695BD1A FOREIGN KEY (identifiantproposition_id) REFERENCES proposition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC3534692951F FOREIGN KEY (userquidemande_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353E0110983 FOREIGN KEY (userquirecois_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC3531740AF21 FOREIGN KEY (articledemande_id) REFERENCES articles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353D389AA71 FOREIGN KEY (articlequirecois_id) REFERENCES articles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353BF605A20 FOREIGN KEY (articlequirecoistrue_id) REFERENCES articles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE articles_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE echange_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE proposition_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE articles DROP CONSTRAINT FK_BFDD3168A76ED395');
        $this->addSql('ALTER TABLE articles DROP CONSTRAINT FK_BFDD3168BCF5E72D');
        $this->addSql('ALTER TABLE echange DROP CONSTRAINT FK_B577E3BF4692951F');
        $this->addSql('ALTER TABLE echange DROP CONSTRAINT FK_B577E3BF7DC6313A');
        $this->addSql('ALTER TABLE echange DROP CONSTRAINT FK_B577E3BF1740AF21');
        $this->addSql('ALTER TABLE echange DROP CONSTRAINT FK_B577E3BF3625B187');
        $this->addSql('ALTER TABLE echange DROP CONSTRAINT FK_B577E3BF7695BD1A');
        $this->addSql('ALTER TABLE proposition DROP CONSTRAINT FK_C7CDC3534692951F');
        $this->addSql('ALTER TABLE proposition DROP CONSTRAINT FK_C7CDC353E0110983');
        $this->addSql('ALTER TABLE proposition DROP CONSTRAINT FK_C7CDC3531740AF21');
        $this->addSql('ALTER TABLE proposition DROP CONSTRAINT FK_C7CDC353D389AA71');
        $this->addSql('ALTER TABLE proposition DROP CONSTRAINT FK_C7CDC353BF605A20');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE echange');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE "user"');
    }
}
