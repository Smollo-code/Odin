#!/usr/bin/env bash

mysqldump -uroot -p"root" odin -rdump.sql 2>&1
