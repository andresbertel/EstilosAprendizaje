SELECT cod_estilo,nombre_estilo,MAX(TOTAL) FROM (select username,es.cod_estilo,es.nombre_estilo,ROUND((COUNT(*)*100 )/(select count(*) totalPreguntas from respuesta_test re1 where re1.username=1102 and re1.cod_test_asignado='101'and re1.cod_opcion_respuesta in(select cod_opcion_respuesta  from opciones_respuesta WHERE cod_estilo<>'9')),2)TOTAL from respuesta_test rt join opciones_respuesta ore 
                                          on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
                                          join estilos es on(es.cod_estilo=ore.cod_estilo)   where cod_test_asignado='101' and username=1102 and ore.cod_estilo<>'9'

                                          group by es.cod_estilo order by TOTAL desc) AS TODO