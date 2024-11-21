import sys
import base64
import binascii
data=sys.argv[1]
str2 = data.strip()
if sys.version_info[0] == 2:
 b64_data = base64.b64encode(str2)
else:
 b64_data = base64.b64encode(str2.encode('utf-8'))

print(binascii.hexlify(b64_data).decode())

#b64_data = binascii.unhexlify(data.strip())
#print(base64.b64decode(b64_data).decode())