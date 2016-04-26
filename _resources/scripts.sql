delete from scores where contestant_id in (select id from contestants where contest_id = 1);
delete from juries where contest_id = 1;
delete from contestants where contest_id =1;
delete from contests where id =  1;