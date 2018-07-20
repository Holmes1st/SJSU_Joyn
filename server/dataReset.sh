#!/bin/bash

if [[ $EUID -ne 0 ]]; then
    echo "You must be a root user" 2>&1
    exit 1
else
    rm -rf data
    mkdir data
    chown "${SUDO_USER}:${SUDO_USER}" data
fi
