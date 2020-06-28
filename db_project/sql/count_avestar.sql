delimiter //
CREATE TRIGGER count_avestar AFTER INSERT ON comment
FOR EACH ROW
begin
	update shop set avestar=(
		select avg(star)
		from comment
		where s_id=new.s_id)
	where s_id=new.s_id;
end;//
delimiter ;