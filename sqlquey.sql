select  employee.emp_id, leave_limit.leave_type, count(*) as leaves_taken, 
leave_limit.leave_limit - count(*) as leaves_remaining ,leave_limit.leave_limit 
from leaves, leave_limit, employee 
where leaves.approval_status = 'True' AND leaves.emp_id = employee.emp_id 
AND employee.pay_grade = leave_limit.pay_grade AND leave_limit.leave_type = leaves.leave_type  
group by emp_id, leave_type;

 select employee.emp_id, leave_limit.leave_type, leave_limit.leave_limit, count(leaves.emp_id) as leaves_taken, leave_limit.leave_limit - count(leaves.emp_id) as leaves_remaining  
from employee left outer join leave_limit on employee.pay_grade = leave_limit.pay_grade 
left outer join leaves on employee.emp_id = leaves.emp_id and leave_limit.leave_type = leaves.leave_type and leaves.approval_status = 'True'
group by emp_id, leave_type

select employee.emp_id, leave_limit.leave_type, leave_limit.leave_limit, ifnull(sum(leaves_days.days),0) as leaves_taken, leave_limit.leave_limit - ifnull(sum(leaves_days.days)) as leaves_remaining  
from employee left outer join leave_limit on employee.pay_grade = leave_limit.pay_grade 
left outer join leaves_days on employee.emp_id = leaves_days.emp_id and leave_limit.leave_type = leaves_days.leave_type and leaves_days.approval_status = 'True'
group by emp_id, leave_type


//trigger for new custom attribute
DELIMITER ??

CREATE TRIGGER after_custom_attribute_insert
AFTER INSERT ON emp_custom FOR EACH ROW

BEGIN
    DECLARE n INT DEFAULT 0;
	DECLARE i INT DEFAULT 0;
    DECLARE empId VARCHAR(10);
	SELECT COUNT(*) FROM employee INTO n;
	SET i=0;
	WHILE i<n DO 
    	SELECT emp_id from employee limit i,1 into empId;
  		INSERT INTO emp_data(emp_id, attribute) VALUES (empId, NEW.attribute);
  		SET i = i + 1;
	END WHILE;
END; ??
DELIMITER ;

//trigger for leave form dates
DELIMITER ??
CREATE TRIGGER check_leave_form_dates
BEFORE INSERT ON leaves FOR EACH ROW
BEGIN
IF (NEW.till_date < NEW.from_date) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'The Selected Date Combination is not Valid';
  END IF;
END; ??	
DELIMITER ;

//trigger for employ history_period
DELIMITER ??
CREATE TRIGGER check_employ_history_period
BEFORE INSERT ON employ_history FOR EACH ROW
BEGIN
IF (NEW.to_date < NEW.from_date) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'The Selected Period of Employment is not Valid';
  END IF;
END; ??	
DELIMITER ;

//Database Roles and Users

CREATE ROLE 'role_admin','role_hrmanager','role_manager','role_supervisor','role_employee';

GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'role_admin';

GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'role_hrmanager';

GRANT SELECT ON *.* TO 'role_employee';
GRANT INSERT ON leaves TO 'role_employee';

GRANT SELECT ON leaves TO 'role_manager';
GRANT SELECT ON leave_limit TO 'role_manager';
GRANT SELECT ON leave_type TO 'role_manager';
GRANT SELECT,UPDATE ON branch TO 'role_manager';
GRANT SELECT,UPDATE ON department TO 'role_manager';
GRANT SELECT,UPDATE ON dependent TO 'role_manager';
GRANT SELECT,UPDATE ON emergency_contact TO 'role_manager';
GRANT SELECT,UPDATE ON employee TO 'role_manager';
GRANT SELECT,UPDATE ON employ_history TO 'role_manager';
GRANT SELECT,UPDATE ON emp_custom TO 'role_manager';
GRANT SELECT,UPDATE ON emp_data TO 'role_manager';
GRANT SELECT,UPDATE ON emp_telephone TO 'role_manager';
GRANT SELECT,UPDATE ON job_title TO 'role_manager';
GRANT SELECT,UPDATE ON pay_grade TO 'role_manager';
GRANT SELECT,UPDATE ON user TO 'role_manager';

GRANT SELECT ON *.* TO 'role_supervisor';
GRANT UPDATE ON leaves TO 'role_supervisor';
GRANT UPDATE ON leave_limit TO 'role_supervisor';
GRANT UPDATE ON leave_type TO 'role_supervisor';

CREATE USER 'admin' IDENTIFIED BY 'adminpass';
CREATE USER 'hrmanager' IDENTIFIED BY 'hrmanagerpass';
CREATE USER 'manager1' IDENTIFIED BY 'manager1pass';
CREATE USER 'supervisor1' IDENTIFIED BY 'supervisor1pass';
CREATE USER 'employee1' IDENTIFIED BY 'employee1pass';

GRANT 'role_admin' TO 'admin';
GRANT 'role_hrmanager' TO 'hrmanager';
GRANT 'role_manager' TO 'manager1';
GRANT 'role_supervisor' TO 'supervisor1';
GRANT 'role_employee' TO 'employee1';