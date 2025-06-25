#!/bin/bash

# Ensure we are in the script directory
cd "$(dirname "$0")"

# check python
if ! command -v python3 &> /dev/null; then
    echo "python3 is not installed. Please install python3 to continue."
    exit 1
fi

# check docker engine
if ! docker info > /dev/null 2>&1; then
    echo "Docker engine is not running. Please start docker and try again."
    exit 1;
fi

python3 run.py