import sqlite3
import sys
domain=sys.argv[1]
database=sys.argv[2]
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("select address,goto,active from alias where domain='"+domain+"'")
for row in cur:
    print(str(row[0])+'|'+str(row[1])+'|'+str(row[2]))
con.close()
