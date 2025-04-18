import sqlite3
import sys
domain=sys.argv[1]
database=sys.argv[2]
user=sys.argv[3]
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("select full_name,is_admin,quota,active from mailbox where local_part='"+str(user)+"' and domain='"+domain+"'")
for row in cur:
    print(str(row[0])+'|'+str(row[1])+'|'+str(row[2])+'|'+str(row[3]))
con.close()
