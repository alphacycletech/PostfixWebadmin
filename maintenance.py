import crypt
from hmac import compare_digest as compare_hash
import sqlite3
import sys
from datetime import datetime
username=sys.argv[1]
domain=sys.argv[2]
password=sys.argv[3]
hashed=crypt.crypt(password, crypt.METHOD_MD5)
quota=sys.argv[4]
is_admin=sys.argv[5]
active=sys.argv[6]
name=sys.argv[7]
now = datetime.now()
modified = now.strftime("%Y-%m-%d %H:%M:%S")
database=sys.argv[8]
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("update mailbox set full_name=?,password=(case when ?='' then password else ? end),quota=?,is_admin=?,active=?,modified=? where domain=? and username=?",(name,password,hashed,quota,is_admin,active,modified,domain,username,))
con.commit()
con.close()