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
cur.execute("select username,password,password_encode,full_name,is_admin,maildir,quota,local_part,domain,created,modified,active,current_usage,quota_active from mailbox where domain=? order by full_name limit ?,10",(domain,row_per_page,))
for row in cur:
    print(str(row[0])+'|'+str(row[3])+'|'+str(row[4])+'|'+str(row[6])+'|'+str(row[7])+'|'+str(row[8])+'|'+str(row[9])+'|'+str(row[10])+'|'+str(row[11])+'|')
con.close()

con2 = sqlite3.connect(database)
cur2 = con2.cursor()
cur2.execute("select count(*) from mailbox where domain='%s' order by full_name" % domain)
for row2 in cur2:
    print(row2)
con2.close()