import crypt
import sqlite3
import sys
from datetime import datetime
forwarder=sys.argv[1]
recipient=sys.argv[2]
domain=sys.argv[3]
active=sys.argv[4]
database=sys.argv[5]
now = datetime.now()
modified = now.strftime("%Y-%m-%d %H:%M:%S")
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("update alias set goto=?,modified=?,active=? where address=? and domain=?",(recipient,modified,active,forwarder,domain,))
con.commit()
con.close()