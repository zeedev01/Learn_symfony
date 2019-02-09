<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180903145636 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO book (id , book_id , book_name, pub_id, book_price) VALUES("2","2","emirlegal","11","55")');
        $this->addSql('INSERT INTO book (id , book_id , book_name, pub_id, book_price) VALUES("3","3","simonjokes","12","65")');
        $this->addSql('INSERT INTO book (id , book_id , book_name, pub_id, book_price) VALUES("4","4","jasminpower","13","62")');
        $this->addSql('INSERT INTO book (id , book_id , book_name, pub_id, book_price) VALUES("5","5","evgenyidea","14","70")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sessions (sess_id VARCHAR(128) NOT NULL COLLATE utf8_bin, sess_data BLOB NOT NULL, sess_time INT UNSIGNED NOT NULL, sess_lifetime INT NOT NULL, PRIMARY KEY(sess_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book CHANGE book_name book_name VARCHAR(123) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
