# metahandle

MetaHandle is a tool to access onchain content on Bitcoin SV (BSV). Instead of accessing it with a txid, you can reference any content to a human readable handle which is stored onchain. So all you need is to search for your handle to access any file you want.

To run it on your own server, you need to just put the two files on the public html folder.

# dependencies

MetaHandle requires the following libraries:

https://github.com/dchest/scrypt-async-js
https://github.com/moneybutton/bsv
https://github.com/ricmoo/aes-js

# see how it works

You can make a full search and view of handles with crawler2.php?handle=[handle]. This will show the full handle transactions and help you to understand of what MetaHandles consist.

# backward compatibility

I updated MetaHandles from version -0.1 to version 0.0. During this I changed the old BitCom address and the order of op_return fields. Old Handles can be access with the crawler2.php file.
