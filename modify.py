import crypt
from hmac import compare_digest as compare_hash
import sqlite3
import sys
from datetime import datetime
import base64
import binascii

username=sys.argv[1]
password=sys.argv[2]
hashed=crypt.crypt(password, crypt.METHOD_MD5)

data=password
str2 = data.strip()
if sys.version_info[0] == 2:
 b64_data = base64.b64encode(str2)
else:
 b64_data = base64.b64encode(str2.encode('utf-8'))
 
pass_encode=binascii.hexlify(b64_data).decode()

now = datetime.now()
modified = now.strftime("%Y-%m-%d %H:%M:%S")
database=sys.argv[3]

con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("update mailbox set password=(case when ?='' then password else ? end),password_encode=(case when ?='' then password_encode else ? end),modified=? where username=?",(password,hashed,password,pass_encode,modified,username,))
con.commit()
con.close()