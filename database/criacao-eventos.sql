SET GLOBAL event_scheduler = ON;

CREATE EVENT etapa_producao_1
ON SCHEDULE EVERY 1 MINUTE
STARTS CURRENT_TIMESTAMP
ENDS CURRENT_TIMESTAMP + INTERVAL '01:00:00' HOUR_SECOND
DO
	UPDATE etapa_producao SET tempo_restante=(
		SELECT DATE_SUB(tempo_restante, INTERVAL 1 minute) FROM etapa_producao WHERE id = 2
	) WHERE id = 2;