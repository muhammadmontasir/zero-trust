#!/bin/bash

# ensure we are in the script directory
cd "$(dirname "$0")"

# Check Python
if ! command -v python3 &> /dev/null; then
    echo "python3 is not install. Please install python3 to continue."
    exit 1;
fi

# check docker desktop
if ! docker info > /dev/null 2>&1; then
    echo "Docker desktop is not running. Please start Docker Desktop and try again."
    open -a Docker
    exit 1
fi


python3 run.py
