<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217144811 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emergency_contact CHANGE emp_id emp_id VARCHAR(10) NOT NULL, CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE pay_grade CHANGE pay_grade pay_grade VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE leave_limit DROP leave_limit, CHANGE pay_grade pay_grade VARCHAR(10) NOT NULL, CHANGE leave_type leave_type VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE leave_limit RENAME INDEX leave_type TO IDX_BA42B1CAE2BC4391');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE emp_custom CHANGE attribute attribute VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE emp_telephone DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE emp_telephone CHANGE emp_id emp_id VARCHAR(10) NOT NULL, CHANGE telephone telephone VARCHAR(12) NOT NULL');
        $this->addSql('ALTER TABLE emp_telephone ADD PRIMARY KEY (telephone, emp_id)');
        $this->addSql('ALTER TABLE employment_status CHANGE emp_status emp_status VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE branch CHANGE branch_id branch_id VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE employee CHANGE emp_id emp_id VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE emp_custom_data DROP value');
        $this->addSql('ALTER TABLE emp_custom_data RENAME INDEX attribute TO IDX_AE543476FA7AEFFB');
        $this->addSql('ALTER TABLE job_title CHANGE job_title job_title VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE department CHANGE dept_name dept_name VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE leave_type CHANGE leave_type leave_type VARCHAR(15) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE branch CHANGE branch_id branch_id VARCHAR(10) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE department CHANGE dept_name dept_name VARCHAR(20) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE emergency_contact CHANGE name name VARCHAR(50) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`, CHANGE emp_id emp_id VARCHAR(10) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE emp_custom CHANGE attribute attribute VARCHAR(20) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE emp_custom_data ADD value VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE emp_custom_data RENAME INDEX idx_ae543476fa7aeffb TO attribute');
        $this->addSql('ALTER TABLE emp_telephone DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE emp_telephone CHANGE telephone telephone VARCHAR(12) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`, CHANGE emp_id emp_id VARCHAR(10) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE emp_telephone ADD PRIMARY KEY (emp_id, telephone)');
        $this->addSql('ALTER TABLE employee CHANGE emp_id emp_id VARCHAR(10) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE employment_status CHANGE emp_status emp_status VARCHAR(20) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE job_title CHANGE job_title job_title VARCHAR(20) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE leave_limit ADD leave_limit INT DEFAULT NULL, CHANGE pay_grade pay_grade VARCHAR(10) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`, CHANGE leave_type leave_type VARCHAR(15) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE leave_limit RENAME INDEX idx_ba42b1cae2bc4391 TO leave_type');
        $this->addSql('ALTER TABLE leave_type CHANGE leave_type leave_type VARCHAR(15) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE pay_grade CHANGE pay_grade pay_grade VARCHAR(10) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(30) CHARACTER SET latin1 DEFAULT \'\' NOT NULL COLLATE `latin1_swedish_ci`');
    }
}
