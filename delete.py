import sqlite3
import sys

domain=sys.argv[1]
username=sys.argv[2]
database=sys.argv[3]

con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("delete from mailbox where domain=? and local_part=?",(domain,username,))
con.commit()
con.close()