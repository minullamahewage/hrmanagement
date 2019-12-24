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