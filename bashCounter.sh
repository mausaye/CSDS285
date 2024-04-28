#!/bin/bash

count=0

while true; do
    read -rsn1 key # no back slash, reads one character
    if [ -z "$key" ]; then # check if length 0
        count=$((count+1))
        echo "Enter key pressed $count times"
    fi
done
