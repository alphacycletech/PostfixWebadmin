import crypt
from hmac import compare_digest as compare_hash
import sqlite3
import sys
from datetime import datetime
import base64
import binascii

email=sys.argv[1]
password=sys.argv[2]
hashed=crypt.crypt(password, crypt.METHOD_MD5)

data=password
str2 = data.strip()
if sys.version_info[0] == 2:
 b64_data = base64.b64encode(str2)
else:
 b64_data = base64.b64encode(str2.encode('utf-8'))
 
pass_encode=binascii.hexlify(b64_data).decode()
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