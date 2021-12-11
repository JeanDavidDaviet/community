<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211211141150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add title to Post Entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE post ADD title VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE post DROP title');
    }
}
