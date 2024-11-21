import pandas as pd
import sqlite3

conn = sqlite3.connect('maillog.db')

conn.execute("DROP TABLE log")
conn.execute("CREATE TABLE log (Date VARCHAR(20),Server VARCHAR(100),QueueId VARCHAR(100),EmailId VARCHAR(100),FromUser VARCHAR(100),ToUser VARCHAR(100),Status VARCHAR(50))")

df = pd.read_csv('/var/log/mail.log', sep='delimiter', header=None, engine='python')
log_array=df.values.tolist()

def replaceMonth(Month):
    if(Month=='Jan'):
        newMonth='01'
    elif(Month=='Feb'):
        newMonth='02'
    elif(Month=='Mar'):
        newMonth='03'
    elif(Month=='Apr'):
        newMonth='04'
    elif(Month=='May'):
        newMonth='05'
    elif(Month=='Jun'):
        newMonth='06'
    elif(Month=='Jul'):
        newMonth='07'
    elif(Month=='Aug'):
        newMonth='08'
    elif(Month=='Sep'):
        newMonth='09'
    elif(Month=='Oct'):
        newMonth='10'
    elif(Month=='Nov'):
        newMonth='11'
    elif(Month=='Dec'):
        newMonth='12'
    
    return newMonth

for x in log_array:
    myDate=replaceMonth(x[0][:3])+"-"+x[0][4:15]
    myServer=x[0][16:25]
    myQueueId='' if x[0].find('[')==-1 else x[0][(x[0].find('['))+1:(x[0].find(']'))]
    myEmailId='' if x[0].find(']')==-1 else x[0][x[0].find(']')+3:x[0].find(']')+14]
    myFrom='' if x[0].find('from=')==-1 else x[0][(x[0].find('from='))+6:(x[0].find('>,'))]
    myTo='' if x[0].find('to=')==-1 else x[0][(x[0].find('to='))+4:(x[0].find('>,'))]
    myStatus='' if x[0].find('status=')==-1 else x[0][(x[0].find('status='))+7:(x[0].find('('))-1]
    conn.execute("INSERT INTO log VALUES ('"+myDate+"','"+myServer+"','"+myQueueId+"','"+myEmailId+"','"+myFrom+"','"+myTo+"','"+myStatus+"')")
    #print(myEmailId)
    
conn.commit()
conn.close()