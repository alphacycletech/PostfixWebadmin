import crypt
from hmac import compare_digest as compare_hash
import sqlite3
import sys
from datetime import datetime
import uuid

email=sys.argv[1]
password=sys.argv[2]
hashed=crypt.crypt(password, crypt.METHOD_MD5)
pass_random = uuid.uuid4().hex
pass_encode = pass_random[0:24]
name=sys.argv[3]
is_admin=sys.argv[4]
maildir=sys.argv[5]
quota=sys.argv[6]
username=sys.argv[7]
domain=sys.argv[8]
now = datetime.now()
created = now.strftime("%Y-%m-%d %H:%M:%S")
modified = now.strftime("%Y-%m-%d %H:%M:%S")
active=1
database=sys.argv[9]

con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("insert into mailbox (username,password,password_encode,full_name,is_admin,maildir,quota,local_part,domain,created,modified,active) values (?,?,?,?,?,?,?,?,?,?,?,?)",(email,hashed,pass_encode,name,is_admin,maildir,quota,username,domain,created,modified,active,))
con.commit()
con.close()