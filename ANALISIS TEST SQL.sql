select username,es.nombre_estilo,COUNT(*) TOTAL from respuesta_test rt join opciones_respuesta ore 
on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
join estilos es on(es.cod_estilo=ore.cod_estilo)

where cod_test_asignado='102'

group by es.cod_estilo


select username,es.nombre_estilo,COUNT(*) TOTAL from respuesta_test rt join opciones_respuesta ore 
on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
join estilos es on(es.cod_estilo=ore.cod_estilo)

where cod_test_asignado='101'

group by es.cod_estilo







