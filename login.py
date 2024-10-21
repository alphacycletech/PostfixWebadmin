import crypt
from hmac import compare_digest as compare_hash
import sqlite3
import sys
username=sys.argv[1]
username2=sys.argv[2]
password=sys.argv[3]
domain=sys.argv[4]
database=sys.argv[5]
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("select * from mailbox where (username=? or local_part=?) and domain=? and is_admin=1",(username,username2,domain))
for row in cur:
    hashed=crypt.crypt(password, crypt.METHOD_MD5)
    if(compare_hash(row[1], crypt.crypt(password, row[1]))):
        print(str(row[0])+'|'+str(row[3]))