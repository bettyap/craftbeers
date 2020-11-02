SELECT * FROM etapa_producao as ep
inner join usuario as us on ep.id_usuario = us.id
where us.id = 1;

select * from processo where id = 1;


insert into etapa_producao (id_usuario, id_processo, tempo_restante) values (1, 1, '01:00:00');

SHOW EVENTS FROM craftbeers;

SET GLOBAL event_scheduler = ON;

SHOW PROCESSLIST;

DROP EVENT etapa_producao_7;

ALTER EVENT etapa_producao_16 ENABLE;

CREATE EVENT etapa_producao_1
ON SCHEDULE EVERY 1 MINUTE
STARTS CURRENT_TIMESTAMP
ENDS CURRENT_TIMESTAMP + INTERVAL '01:00:00' HOUR_SECOND
DO
	UPDATE etapa_producao SET tempo_restante=(
		SELECT DATE_SUB(tempo_restante, INTERVAL 1 minute) FROM etapa_producao WHERE id = 7
	) WHERE id = 7;
	
	
DELETE FROM etapa_producao WHERE id = 10; DROP EVENT etapa_producao_10;


SELECT * FROM processo WHERE id > 5 ORDER BY id LIMIT 1;

SELECT * FROM processo AS proc
INNER JOIN categoria AS cat ON cat.id = proc.id_categoria
WHERE proc.id > 1 ORDER BY proc.id LIMIT 1;

UPDATE etapa_producao SET id_processo = 2, tempo_restante = '02:00:00' WHERE id = 16;