<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180101212533 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY fk_goods_order_order_content');
        $this->addSql('DROP TABLE goods_order');
        $this->addSql('DROP TABLE order_content');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY fk_product_comments');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY fk_user_comments');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4584665A FOREIGN KEY (product_id) REFERENCES product (product_id)');
        $this->addSql('ALTER TABLE comments RENAME INDEX fk_user_comments TO IDX_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE comments RENAME INDEX fk_product_comments TO IDX_5F9E962A4584665A');
        $this->addSql('ALTER TABLE genre CHANGE genre_name genre_name VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE genre RENAME INDEX genre_name TO UNIQ_835033F8E5CEA7F6');
        $this->addSql('ALTER TABLE platform CHANGE platform_name platform_name VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE platform RENAME INDEX platform_name TO UNIQ_3952D0CBDA2B192A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY fk_genre_product');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY fk_platform_product');
        $this->addSql('ALTER TABLE product CHANGE picture picture VARCHAR(200) NOT NULL, CHANGE delivery_time delivery_time INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDA2B192A FOREIGN KEY (platform_name) REFERENCES platform (platform_id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE5CEA7F6 FOREIGN KEY (genre_name) REFERENCES genre (genre_id)');
        $this->addSql('ALTER TABLE product RENAME INDEX fk_platform_product TO IDX_D34A04ADDA2B192A');
        $this->addSql('ALTER TABLE product RENAME INDEX fk_genre_product TO IDX_D34A04ADE5CEA7F6');
        $this->addSql('ALTER TABLE user DROP joined');
        $this->addSql('ALTER TABLE user RENAME INDEX user_name TO UNIQ_8D93D64924A232CF');
        $this->addSql('ALTER TABLE user RENAME INDEX user_email TO UNIQ_8D93D649550872C');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE goods_order (order_id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, price INT NOT NULL, first_name VARCHAR(50) NOT NULL COLLATE utf8_czech_ci, last_name VARCHAR(50) NOT NULL COLLATE utf8_czech_ci, e_mail VARCHAR(50) NOT NULL COLLATE utf8_czech_ci, phone VARCHAR(12) NOT NULL COLLATE utf8_czech_ci, street VARCHAR(50) NOT NULL COLLATE utf8_czech_ci, city VARCHAR(50) NOT NULL COLLATE utf8_czech_ci, psc VARCHAR(6) NOT NULL COLLATE utf8_czech_ci, delivery_means VARCHAR(50) NOT NULL COLLATE utf8_czech_ci, payment_means VARCHAR(50) NOT NULL COLLATE utf8_czech_ci, delivered TINYINT(1) NOT NULL, info VARCHAR(500) DEFAULT NULL COLLATE utf8_czech_ci, INDEX fk_user_goods_order (user_id), PRIMARY KEY(order_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_content (product_id INT NOT NULL, order_id INT NOT NULL, count INT NOT NULL, INDEX fk_goods_order_order_content (order_id), INDEX IDX_8BF99E24584665A (product_id), PRIMARY KEY(product_id, order_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE goods_order ADD CONSTRAINT fk_user_goods_order FOREIGN KEY (user_id) REFERENCES user (user_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT fk_goods_order_order_content FOREIGN KEY (order_id) REFERENCES goods_order (order_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT fk_product_order_content FOREIGN KEY (product_id) REFERENCES product (product_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4584665A');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_product_comments FOREIGN KEY (product_id) REFERENCES product (product_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_user_comments FOREIGN KEY (user_id) REFERENCES user (user_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comments RENAME INDEX idx_5f9e962aa76ed395 TO fk_user_comments');
        $this->addSql('ALTER TABLE comments RENAME INDEX idx_5f9e962a4584665a TO fk_product_comments');
        $this->addSql('ALTER TABLE genre CHANGE genre_name genre_name VARCHAR(30) NOT NULL COLLATE utf8_czech_ci');
        $this->addSql('ALTER TABLE genre RENAME INDEX uniq_835033f8e5cea7f6 TO genre_name');
        $this->addSql('ALTER TABLE platform CHANGE platform_name platform_name VARCHAR(20) NOT NULL COLLATE utf8_czech_ci');
        $this->addSql('ALTER TABLE platform RENAME INDEX uniq_3952d0cbda2b192a TO platform_name');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADDA2B192A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE5CEA7F6');
        $this->addSql('ALTER TABLE product CHANGE picture picture VARCHAR(200) DEFAULT NULL COLLATE utf8_czech_ci, CHANGE delivery_time delivery_time INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT fk_genre_product FOREIGN KEY (genre_name) REFERENCES genre (genre_name) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT fk_platform_product FOREIGN KEY (platform_name) REFERENCES platform (platform_name) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_d34a04adda2b192a TO fk_platform_product');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_d34a04ade5cea7f6 TO fk_genre_product');
        $this->addSql('ALTER TABLE user ADD joined DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d64924a232cf TO user_name');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649550872c TO user_email');
    }
}
