#!/bin/awk -f

function shuffle(str,    i, j, tmp) {
    # Shuffle the characters in the string
    for (i = length(str); i > 1; i--) {
        j = int(rand() * i) + 1;
        tmp = substr(str, j, 1);
        str = substr(str, 1, j-1) substr(str, i, 1) substr(str, j+1);
        str = substr(str, 1, i-1) tmp substr(str, i);
    }
    return str;
}

BEGIN {
    srand();  # Seed the random number generator
    print "Enter your name:";
    getline name < "-";
    print "Enter your birthday (MMDD):";
    getline birthday < "-";
    print "Enter your favorite color:";
    getline color < "-";

    # Shuffle the name, birthday, and color
    name = shuffle(name);
    birthday = shuffle(birthday);
    color = shuffle(color);

    # Generate a random password based on the input
    password = substr(name, 1, 1) tolower(substr(name, 2)) \
            substr(birthday, 1, 1) tolower(substr(birthday, 2)) \
            substr(color, 1, 1) tolower(substr(color, 2));

    # Add more characters to the password
    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for (i = 1; i <= 4; i++) {
        password = password substr(charset, int(rand() * length(charset)) + 1, 1);
    }

    print "Your random password is: " password;
}
