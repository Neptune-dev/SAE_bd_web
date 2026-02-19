#!/bin/bash

docker exec -it myapp-oracle \
bash -lc "sqlplus myapp/MyAppPassw0rd\!@FREEPDB1"