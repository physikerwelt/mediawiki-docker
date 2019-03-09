#!/bin/bash
if [ ! -f secret/db_root_password.txt ]; then
  echo "$(pwgen -1 32)" > secret/db_root_password.txt
fi 