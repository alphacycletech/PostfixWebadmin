import crypt
from hmac import compare_digest as compare_hash
import sqlite3
import sys
from datetime import datetime

username=sys.argv[1]
password=sys.argv[2]
hashed=crypt.crypt(password, crypt.METHOD_MD5)
now = datetime.now()
modified = now.strftime("%Y-%m-%d %H:%M:%S")
database=sys.argv[3]

con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("update mailbox set password=(case when ?='' then password else ? end),modified=? where username=?",(password,hashed,modified,username,))
con.commit()
con.close()