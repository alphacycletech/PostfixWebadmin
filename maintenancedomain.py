import sqlite3
import sys

domain=sys.argv[1]
mailboxes=sys.argv[2]
quota=int(sys.argv[3])*1024*1024
database=sys.argv[4]
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("update domain set mailboxes=?,quota=? where domain=?",(mailboxes,quota,domain,))
con.commit()
con.close()