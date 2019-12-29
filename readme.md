![SimpleIgniter Logo](https://i.imgur.com/aEcPG6H.png)

# What is SimpleIgniter

SimpleIgniter is, simply put, CodeIgniter 3 with a user system incorporated. It has
a user system with the ability to  register, login, and recover account via email.
The framework also has an admin system where you can view all the users created,
edit their information, and even delete them.

The program also has a user edit form, a custom role system for Users, Moderators,
and Administrators (only implements features for Administrators), a ban/deactivation
of accounts system, an an active checker to see if accounts are banned/deactivated
while they are online.

## What is Codeigniter

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

## Changelog and New Features

You can find a list of all changes at https://github.com/Satelliting/SimpleIgniter.

## Server Requirements

PHP version 7.1.0 or newer is recommended.

It should work on 5.6 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

IF YOU WISH TO RUN ON OLDER VERSION, YOU MUST CHANGE THE ENCRYPTION SETTINGS.
The MY_Encryption library file needs to be changed from sha3-512 to a different version
supported on older versions.

## Installation

Please see the [installation section](https://codeigniter.com/user_guide/installation/index.html)
of the CodeIgniter User Guide.

To email users from the admin system, you also need to setup the SMTP settings in the
config/email file. You are free to change them from SMTP to something else, but I use
SMTP which is why its setup for it. 

## Resources

- [User Guide](https://codeigniter.com/docs)
- [Language File Translations](https://github.com/bcit-ci/codeigniter3-translations)
- [Community Forums](http://forum.codeigniter.com/)
- [Community Wiki](https://github.com/bcit-ci/CodeIgniter/wiki)
- [Community Slack Channel](https://codeigniterchat.slack.com)

## Acknowledgement

I would like to thank the CodeIgniter team for creating and maintaining an incredible
product and solution for PHP developers and learners. It has taught me a lot and has been
an excellent resource for me to base my projects around.

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
