import pandas as pd
import sqlite3
import glob

conn = sqlite3.connect('maillog.db')

conn.execute("DROP TABLE log")
conn.execute("CREATE TABLE log (Date VARCHAR(50),Server VARCHAR(100),QueueId VARCHAR(100),EmailId VARCHAR(100),FromUser VARCHAR(100),ToUser VARCHAR(100),Status VARCHAR(50))")

for file in glob.glob('/var/log/mail.log*'):
    if('gz' not in file):
        df = pd.read_csv(file, sep='delimiter', header=None, engine='python')
        log_array=df.values.tolist()
        log_array2=[str(item).replace("'", "") for item in log_array]

        for x in log_array2:
            y=str(x)[1:-1]
            myDate=str(y[0:31].replace('T',' '))[0:19]
            myServer=y[33:42]
            myQueueId='' if y.find('[')==-1 else y[(y.find('['))+1:(y.find(']'))]
            myEmailId='' if y.find(']')==-1 else y[y.find(']')+3:y.find(']')+14]
            myFrom='' if y.find('from=')==-1 else y[(y.find('from='))+6:(y.find('>,'))]
            myTo='' if y.find('to=')==-1 else y[(y.find('to='))+4:(y.find('>,'))]
            myStatus='' if y.find('status=')==-1 else y[(y.find('status='))+7:(y.find('('))-1]
            conn.execute("INSERT INTO log VALUES ('"+myDate+"','"+myServer+"','"+myQueueId+"','"+myEmailId+"','"+myFrom+"','"+myTo+"','"+myStatus+"')")
    #print(myEmailId)
    
conn.commit()
conn.close()