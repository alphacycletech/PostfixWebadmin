This is the web based administration panel for postfix email service, but it's only tested and working in ubuntu 20.04 and later.

Changelog

2024-10-01 2.4 added autofocus in input field and centered login textbox

2024-09-30 2.3 changed the entire UI with bootstrap framework, mobile view is not supported at this version.

2024-09-28 2.2 fixed the password encode issue which cause the mailbox tab in mailserver prompts error

2024-07-15 2.1 top left icon in home links to setting to customize icon, title, footer, background and so on. backup your config.php before the update.

2021-10-11 2.0 updated rasterized icon.

2021-09-13 1.9 updated changelog preview layout.

2021-09-11 1.8 added changelog preview.

2021-09-11 1.7 changed the update url.

2021-09-10 1.6 added pagination & resized the edit & delete icon.

2021-09-08 1.5 added mobile responsive support.

2021-09-08 1.4 converted database access from php to python to increase security.

2021-09-01 1.3 list user & forwarder order by name & forwarder address.

2021-09-01 1.2 cannot skip update and straight to the latest version. added changelog.

2021-09-01 1.1 fixed button alignment to center. added check for update function.


Instruction of installing this administration tool.
1. You can simply extract it to the root directory of a sub domain or a directory of a main domain
![image](https://github.com/user-attachments/assets/91a2ebe1-acfb-4165-a743-b95288a754f9)

2. Change the info to suit yourself in config.php and config.ini. the database path should be pointing to the default mailserver location which is /www/vmail/postfixadmin.db, in case your database name or path is different, you may change it.
![image](https://github.com/user-attachments/assets/7afe3ea4-cba5-40d6-8a5f-f67d3f1c81b6)

3. You need to change the /www/vmail directory permission to allow www to access.
chmod 770 /www/vmail
chown vmail:www /www/vmail
chmod 660 /www/vmail/postfixadmin.db
chown vmail:www /www/vmail/postfixadmin.db

4. Go to terminal, enter sudo visudo
add this line to last row of the User privilege specification, www ALL=NOPASSWD: ALL
(this step might be risky for some people, as it might expose your security to public. if you have concern regarding the security, please skip this step. this step will show you the usage by each account, if you skip this step, each account will return 0 in the usage.)
![image](https://github.com/user-attachments/assets/ee0bccd6-b410-4ca1-8b3c-2abcd1397ca1)

6. This administration tool is not compatible with php 8.x, you will need to switch it to php 7.4 or below
It should be more than enough for those who wanna do a email hosting for multiple domains or clients. it works like a reseller function for the email hosting.
