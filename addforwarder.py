import crypt
import sqlite3
import sys
from datetime import datetime

forwarder=sys.argv[1]
recipient=sys.argv[2]
domain=sys.argv[3]
database=sys.argv[4]
now = datetime.now()
created = now.strftime("%Y-%m-%d %H:%M:%S")
modified = now.strftime("%Y-%m-%d %H:%M:%S")
active=1

con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("insert into alias (address,goto,domain,created,modified,active) values (?,?,?,?,?,?)",(forwarder,recipient,domain,created,modified,active,))
con.commit()
con.close()