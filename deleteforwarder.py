import sqlite3
import sys

domain=sys.argv[1]
forwarder=sys.argv[2]
database=sys.argv[3]

con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("delete from alias where domain=? and address=?",(domain,forwarder,))
con.commit()
con.close()