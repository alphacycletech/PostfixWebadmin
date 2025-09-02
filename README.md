<h1>This is the web based administration panel for postfix email service, but it's only tested and working in ubuntu 20.04 and later.</h1>

<h2>Changelog</h2>
2025-09-02 3.4 added "check dependencies" button at landing page bottom right, it will validate each required function to ensure installed or enabled.<br/><br/>
2025-05-06 3.3 added domain maintenance as of the latest postfix & dovecot update.<br/><br/>
2025-05-02 3.2 fixed trace log indexing issue.<br/><br/>
2025-04-18 3.1 optimized some scripts and enhanced security.<br/><br/>
2025-04-16 3.0 fixed and optimized page length issue.<br/><br/>
2025-04-16 2.9 trace log changed to descending in ordering.<br/><br/>
2025-04-11 2.8 fixed some bugs, datetime format in trace and removed change password function.<br/><br/>
2024-12-04 2.7 fixed on login check function and updated support up to php 8.3.<br/><br/>
2024-12-02 2.6 increased date range of mail trace.<br/><br/>
2024-11-21 2.5 added email trace feature, untested. update security of bruteforce attack.<br/><br/>
2024-10-01 2.4 added autofocus in input field and centered login textbox<br/><br/>
2024-09-30 2.3 changed the entire UI with bootstrap framework, mobile view is not supported at this version.<br/><br/>
2024-09-28 2.2 fixed the password encode issue which cause the mailbox tab in mailserver prompts error<br/><br/>
2024-07-15 2.1 top left icon in home links to setting to customize icon, title, footer, background and so on. backup your config.php before the update.<br/><br/>
2021-10-11 2.0 updated rasterized icon.<br/><br/>
2021-09-13 1.9 updated changelog preview layout.<br/><br/>
2021-09-11 1.8 added changelog preview.<br/><br/>
2021-09-11 1.7 changed the update url.<br/><br/>
2021-09-10 1.6 added pagination & resized the edit & delete icon.<br/><br/>
2021-09-08 1.5 added mobile responsive support.<br/><br/>
2021-09-08 1.4 converted database access from php to python to increase security.<br/><br/>
2021-09-01 1.3 list user & forwarder order by name & forwarder address.<br/><br/>
2021-09-01 1.2 cannot skip update and straight to the latest version. added changelog.<br/><br/>
2021-09-01 1.1 fixed button alignment to center. added check for update function.<br/><br/>
<br/><br/>
<h3>Instruction of installing this administration tool.</h3>
1. You can simply extract it to the root directory of a sub domain or a directory of a main domain.

![image](https://github.com/user-attachments/assets/31eb9593-e2c4-4b03-9315-2196f4471507)
<br/><br/>
2. Change the info to suit yourself in $\color{red}{config.php}$ and $\color{red}{config.ini}$. the database path should be pointing to the default mailserver location which is $\color{red}{/www/vmail/postfixadmin.db}$, in case your database name or path is different, you may change it.

![image](https://github.com/user-attachments/assets/7afe3ea4-cba5-40d6-8a5f-f67d3f1c81b6)

3. You need to change the /www/vmail directory permission to allow www to access.<br/>
$\color{red}{chmod\ 770\ /www/vmail}$<br/>
$\color{red}{chown\ vmail:www\ /www/vmail}$<br/>
$\color{red}{chmod\ 660\ /www/vmail/postfixadmin.db}$<br/>
$\color{red}{chown\ vmail:www\ /www/vmail/postfixadmin.db}$<br/>


4. Go to terminal, enter sudo visudo
add this line to last row of the User privilege specification,<br/>
$\color{red}{www\ ALL=NOPASSWD:\ ALL}$<br/>
(this step might be risky for some people, as it might expose your security to public. if you have concern regarding the security, please skip this step. this step will show you the usage by each account, if you skip this step, each account will return 0 in the usage.)

![image](https://github.com/user-attachments/assets/ee0bccd6-b410-4ca1-8b3c-2abcd1397ca1)

5. You can check for the dependencies to ensure they are enabled or installed for this system to work.

   
6. You will need to install some python dependencies<br/>
$\color{red}{Ubuntu\ 24.08\ and\ Python3}$<br/>
$\color{red}{sudo\ apt\ install\ python3-pandas}$<br/>
$\color{red}{Below\ Ubuntu\ 24.08\ and\ Python3}$<br/>
$\color{red}{sudo\ python3\ -m\ pip\ install\ pandas}$<br/>

7. Configure your mail log date format to standard YYYY-mm-dd H:i:s<br/>
$\color{red}{Goto\ rsyslog\ conf}$<br/>
$\color{red}{sudo\ nano\ /etc/rsyslog.conf}$<br/>
Under Global Directives, comment out the existing style such as "$ActionFileDefaultTemplate\ RSYSLOG_TraditionalFileFormat"<br/>
$\color{red}{sudo\ systemctl\ restart\ rsyslog}$<br/>

8. Your very own administration panel is now online.

![image](https://github.com/user-attachments/assets/d2b8ab27-1aec-419f-8552-45069f6ae2f0)


