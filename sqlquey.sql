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