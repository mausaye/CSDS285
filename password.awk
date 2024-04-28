#!/bin/awk -f

function shuffle_string(str,    i, j, tmp, shuffled) {
    # Create an array to store the shuffled indices
    for (i = 1; i <= length(str); i++) {
        shuffled[i] = i;
    }
    # Shuffle the indices
    for (i = length(str); i > 1; i--) {
        j = int(rand() * i) + 1;
        tmp = shuffled[j];
        shuffled[j] = shuffled[i];
        shuffled[i] = tmp;
    }
    # Create the shuffled string
    shuffled_str = "";
    for (i = 1; i <= length(str); i++) {
        shuffled_str = shuffled_str substr(str, shuffled[i], 1);
    }

    return shuffled_str;
}
BEGIN {
    srand();  # Seed the random number generator
    print "Enter your name:";
    getline name < "-";
    print "Enter your birthday (MMDD):";
    getline birthday < "-";
    print "Enter your favorite color:";
    getline color < "-";

    # Generate a password based on the input
    password = substr(name, 1, 1) tolower(substr(name, 2)) \
            substr(birthday, 1, 1) tolower(substr(birthday, 2)) \
            substr(color, 1, 1) tolower(substr(color, 2));

    # Add more characters to the password
    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for (i = 1; i <= 5; i++) {
        password = password substr(charset, int(rand() * length(charset)) + 1, 1);
    }
    # Shuffle the order of the characters in the password
    password = shuffle_string(password);
    print "Your random password is: " password;
}
