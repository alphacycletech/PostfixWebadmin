import crypt
from hmac import compare_digest as compare_hash
import sqlite3
import sys
domain=sys.argv[1]
database=sys.argv[2]
page=int(sys.argv[3])
row_per_page=(page-1)*10
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("select * from alias where domain=? order by address limit ?,10",(domain,row_per_page,))
for row in cur:
    print(str(row[0])+'|'+str(row[1])+'|'+str(row[2])+'|'+str(row[3])+'|'+str(row[4])+'|'+str(row[5])+'|')
con.close()

con2 = sqlite3.connect(database)
cur2 = con2.cursor()
cur2.execute("select count(*) from alias where domain='%s' order by address" % domain)
for row2 in cur2:
    print(row2)
con2.close()