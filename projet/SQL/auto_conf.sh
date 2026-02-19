#!/bin/bash
docker cp /Users/antoinehorber/Desktop/SAE/SQL/CREATE.sql myapp-oracle:/CREATE.sql
docker cp /Users/antoinehorber/Desktop/SAE/SQL/INSERT.sql myapp-oracle:/INSERT.sql
docker cp /Users/antoinehorber/Desktop/SAE/SQL/DROP.sql myapp-oracle:/DROP.sql
docker exec -it myapp-oracle bash -lc 'sqlplus myapp/MyAppPassw0rd\!@FREEPDB1 @/DROP.sql'
docker exec -it myapp-oracle bash -lc 'sqlplus myapp/MyAppPassw0rd\!@FREEPDB1 @/CREATE.sql'
docker exec -it myapp-oracle bash -lc 'sqlplus myapp/MyAppPassw0rd\!@FREEPDB1 @/INSERT.sql'