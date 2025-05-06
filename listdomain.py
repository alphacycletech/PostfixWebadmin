import sqlite3
import sys
domain=sys.argv[1]
database=sys.argv[2]
page=int(sys.argv[3])
row_per_page=(page-1)*10
con = sqlite3.connect(database)
cur = con.cursor()
cur.execute("select domain,a_record,active,mailboxes,quota,rate_limit,ssl_alarm,current_usage,created from domain where domain=? order by domain limit ?,10",(domain,row_per_page,))
for row in cur:
    print(str(row[0])+'|'+str(row[1])+'|'+str(row[2])+'|'+str(row[3])+'|'+str(row[4])+'|'+str(row[5])+'|'+str(row[6])+'|'+str(row[7])+'|'+str(row[8])+'|')
con.close()

con2 = sqlite3.connect(database)
cur2 = con2.cursor()
cur2.execute("select count(*) from domain where domain='%s' order by domain" % domain)
for row2 in cur2:
    print(row2)
con2.close()