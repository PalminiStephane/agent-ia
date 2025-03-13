<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250313233038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_profile (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, industry VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, target_audience LONGTEXT DEFAULT NULL, tone_of_voice LONGTEXT DEFAULT NULL, content_preferences LONGTEXT DEFAULT NULL, logo_url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_DC641142A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_calendar (id INT AUTO_INCREMENT NOT NULL, business_profile_id INT NOT NULL, topic_id INT DEFAULT NULL, content_item_id INT DEFAULT NULL, platform VARCHAR(20) DEFAULT NULL, planned_date DATE NOT NULL, content_type VARCHAR(20) NOT NULL, status VARCHAR(20) NOT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_3C1E4BA9C591A13 (business_profile_id), INDEX IDX_3C1E4BA91F55203D (topic_id), INDEX IDX_3C1E4BA9CD678BED (content_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_item (id INT AUTO_INCREMENT NOT NULL, business_profile_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, content_text LONGTEXT DEFAULT NULL, media_urls LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', hashtags LONGTEXT DEFAULT NULL, ai_prompt LONGTEXT DEFAULT NULL, generated_at DATETIME NOT NULL, status VARCHAR(20) NOT NULL, metadata LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_D279C8DBC591A13 (business_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_topic (id INT AUTO_INCREMENT NOT NULL, business_profile_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, keywords LONGTEXT DEFAULT NULL, priority INT NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_76838AC9C591A13 (business_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE openai_api_log (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, endpoint VARCHAR(100) NOT NULL, request_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', response_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', tokens_used INT NOT NULL, duration_ms INT NOT NULL, status_code INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_1067D0EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_analytics (id INT AUTO_INCREMENT NOT NULL, scheduled_post_id INT NOT NULL, likes INT NOT NULL, comments INT NOT NULL, shares INT NOT NULL, clicks INT NOT NULL, impressions INT NOT NULL, reach INT NOT NULL, engagement_rate NUMERIC(5, 2) NOT NULL, last_updated DATETIME NOT NULL, raw_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', UNIQUE INDEX UNIQ_4BAC987F2F4E5568 (scheduled_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scheduled_post (id INT AUTO_INCREMENT NOT NULL, content_item_id INT NOT NULL, social_account_id INT NOT NULL, scheduled_for DATETIME NOT NULL, custom_text LONGTEXT DEFAULT NULL, post_status VARCHAR(20) NOT NULL, post_id VARCHAR(255) DEFAULT NULL, post_url VARCHAR(255) DEFAULT NULL, published_at DATETIME DEFAULT NULL, error_message LONGTEXT DEFAULT NULL, INDEX IDX_954B2BA4CD678BED (content_item_id), INDEX IDX_954B2BA45538ED78 (social_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_account (id INT AUTO_INCREMENT NOT NULL, business_profile_id INT NOT NULL, platform VARCHAR(20) NOT NULL, account_identifier VARCHAR(100) NOT NULL, access_token LONGTEXT DEFAULT NULL, refresh_token LONGTEXT DEFAULT NULL, token_expires_at DATETIME DEFAULT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F24D8339C591A13 (business_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_profile ADD CONSTRAINT FK_DC641142A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE content_calendar ADD CONSTRAINT FK_3C1E4BA9C591A13 FOREIGN KEY (business_profile_id) REFERENCES business_profile (id)');
        $this->addSql('ALTER TABLE content_calendar ADD CONSTRAINT FK_3C1E4BA91F55203D FOREIGN KEY (topic_id) REFERENCES content_topic (id)');
        $this->addSql('ALTER TABLE content_calendar ADD CONSTRAINT FK_3C1E4BA9CD678BED FOREIGN KEY (content_item_id) REFERENCES content_item (id)');
        $this->addSql('ALTER TABLE content_item ADD CONSTRAINT FK_D279C8DBC591A13 FOREIGN KEY (business_profile_id) REFERENCES business_profile (id)');
        $this->addSql('ALTER TABLE content_topic ADD CONSTRAINT FK_76838AC9C591A13 FOREIGN KEY (business_profile_id) REFERENCES business_profile (id)');
        $this->addSql('ALTER TABLE openai_api_log ADD CONSTRAINT FK_1067D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post_analytics ADD CONSTRAINT FK_4BAC987F2F4E5568 FOREIGN KEY (scheduled_post_id) REFERENCES scheduled_post (id)');
        $this->addSql('ALTER TABLE scheduled_post ADD CONSTRAINT FK_954B2BA4CD678BED FOREIGN KEY (content_item_id) REFERENCES content_item (id)');
        $this->addSql('ALTER TABLE scheduled_post ADD CONSTRAINT FK_954B2BA45538ED78 FOREIGN KEY (social_account_id) REFERENCES social_account (id)');
        $this->addSql('ALTER TABLE social_account ADD CONSTRAINT FK_F24D8339C591A13 FOREIGN KEY (business_profile_id) REFERENCES business_profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business_profile DROP FOREIGN KEY FK_DC641142A76ED395');
        $this->addSql('ALTER TABLE content_calendar DROP FOREIGN KEY FK_3C1E4BA9C591A13');
        $this->addSql('ALTER TABLE content_calendar DROP FOREIGN KEY FK_3C1E4BA91F55203D');
        $this->addSql('ALTER TABLE content_calendar DROP FOREIGN KEY FK_3C1E4BA9CD678BED');
        $this->addSql('ALTER TABLE content_item DROP FOREIGN KEY FK_D279C8DBC591A13');
        $this->addSql('ALTER TABLE content_topic DROP FOREIGN KEY FK_76838AC9C591A13');
        $this->addSql('ALTER TABLE openai_api_log DROP FOREIGN KEY FK_1067D0EEA76ED395');
        $this->addSql('ALTER TABLE post_analytics DROP FOREIGN KEY FK_4BAC987F2F4E5568');
        $this->addSql('ALTER TABLE scheduled_post DROP FOREIGN KEY FK_954B2BA4CD678BED');
        $this->addSql('ALTER TABLE scheduled_post DROP FOREIGN KEY FK_954B2BA45538ED78');
        $this->addSql('ALTER TABLE social_account DROP FOREIGN KEY FK_F24D8339C591A13');
        $this->addSql('DROP TABLE business_profile');
        $this->addSql('DROP TABLE content_calendar');
        $this->addSql('DROP TABLE content_item');
        $this->addSql('DROP TABLE content_topic');
        $this->addSql('DROP TABLE openai_api_log');
        $this->addSql('DROP TABLE post_analytics');
        $this->addSql('DROP TABLE scheduled_post');
        $this->addSql('DROP TABLE social_account');
        $this->addSql('DROP TABLE user');
    }
}
