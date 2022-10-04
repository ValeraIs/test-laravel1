#!/bin/bash

echo_grn() {
    echo -e "${GREEN}$1 ${NC}";
}

showNginxPort() {
    echo_grn "Nginx now run on:";
    docker port $(sudo docker ps -q --filter 'name=test-nginx')
}

run() {
    installVendor;
    echo_grn "Run docker."
    docker-compose -f ./docker/docker-compose.yml down
    docker-compose -f ./docker/docker-compose.yml up -d
    showNginxPort;
}

run