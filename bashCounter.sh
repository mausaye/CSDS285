#!/bin/bash

count=0

while true; do
    read -rsn1 key
    if [ -z "$key" ]; then
        count=$((count+1))
        echo "Enter key pressed $count times"
    fi
done
