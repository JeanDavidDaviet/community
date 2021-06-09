<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210609155057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_9474526C4B89032C');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, author_id, post_id, content, created_at, updated_at FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, post_id INTEGER NOT NULL, content CLOB NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, author_id, post_id, content, created_at, updated_at) SELECT id, author_id, post_id, content, created_at, updated_at FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('DROP INDEX IDX_140AB6207ECBDE67');
        $this->addSql('CREATE TEMPORARY TABLE __temp__page AS SELECT id, page_group_id, slug, content, created_at, published_at, updated_at, title FROM page');
        $this->addSql('DROP TABLE page');
        $this->addSql('CREATE TABLE page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_group_id INTEGER DEFAULT NULL, slug VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB DEFAULT NULL COLLATE BINARY, created_at DATETIME NOT NULL, published_at DATETIME DEFAULT NULL, updated_at DATETIME NOT NULL, title VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_140AB6207ECBDE67 FOREIGN KEY (page_group_id) REFERENCES page_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO page (id, page_group_id, slug, content, created_at, published_at, updated_at, title) SELECT id, page_group_id, slug, content, created_at, published_at, updated_at, title FROM __temp__page');
        $this->addSql('DROP TABLE __temp__page');
        $this->addSql('CREATE INDEX IDX_140AB6207ECBDE67 ON page (page_group_id)');
        $this->addSql('ALTER TABLE page_group ADD COLUMN slug VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, author_id, content, created_at, updated_at FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, content CLOB NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, author_id, content, created_at, updated_at) SELECT id, author_id, content, created_at, updated_at FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_9474526CF675F31B');
        $this->addSql('DROP INDEX IDX_9474526C4B89032C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, author_id, post_id, content, created_at, updated_at FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, post_id INTEGER NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO comment (id, author_id, post_id, content, created_at, updated_at) SELECT id, author_id, post_id, content, created_at, updated_at FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('DROP INDEX IDX_140AB6207ECBDE67');
        $this->addSql('CREATE TEMPORARY TABLE __temp__page AS SELECT id, page_group_id, slug, content, created_at, published_at, updated_at, title FROM page');
        $this->addSql('DROP TABLE page');
        $this->addSql('CREATE TABLE page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_group_id INTEGER DEFAULT NULL, slug VARCHAR(255) NOT NULL, content CLOB DEFAULT NULL, created_at DATETIME NOT NULL, published_at DATETIME DEFAULT NULL, updated_at DATETIME NOT NULL, title VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO page (id, page_group_id, slug, content, created_at, published_at, updated_at, title) SELECT id, page_group_id, slug, content, created_at, published_at, updated_at, title FROM __temp__page');
        $this->addSql('DROP TABLE __temp__page');
        $this->addSql('CREATE INDEX IDX_140AB6207ECBDE67 ON page (page_group_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__page_group AS SELECT id, title FROM page_group');
        $this->addSql('DROP TABLE page_group');
        $this->addSql('CREATE TABLE page_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO page_group (id, title) SELECT id, title FROM __temp__page_group');
        $this->addSql('DROP TABLE __temp__page_group');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, author_id, content, created_at, updated_at FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO post (id, author_id, content, created_at, updated_at) SELECT id, author_id, content, created_at, updated_at FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
    }
}
