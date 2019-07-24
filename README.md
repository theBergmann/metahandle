# metahandle

MetaHandle is a tool to access onchain content on Bitcoin SV (BSV). Instead of accessing it with a txid, you can reference any content to a human readable handle which is stored onchain. So all you need is to search for your handle to access any file you want.

# dependencies

MetaHandle requires the following libraries:

https://github.com/dchest/scrypt-async-js

https://github.com/moneybutton/bsv

https://github.com/ricmoo/aes-js

# documentation

A MetaHandle is a BSV transaction putting a specifically structured content in the OP_RETURN field. The goal is to allow a user to access another transaction id and metadata with any word he choses.

This is the structure of the OP_Return output:

`"s1": "1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU",
"s2": [Hash(handle)],
"s3": [VersionNumber],
"s4": [txid],
"s5" - "sn": [any meta data]`

s1 is the BitCom address of MetaHandle. It is registered, but only filled with documentary content. It allows to identify a handle transaction. 
s2 is the Hash of the Handle. When the user knows the name of the handle, he can search for the hash. This allows to keep a handle private. Currently SHA256 is used, but it can be updated if required.
s3 is the VersionNumber. It defines how a handle has to be dessolved.
s4 is the id of the transaction which contains the content you want to link to.
s5-sn is for meta data like a title, an description and so on.

Currently existing VersionNumbers are 010102 and 010202. Both interprete s5-sn in the same way: s5 is title, s6 a description. Both are encrypted using AES and the handle as a password. The salt for decryption is in s7. The difference between the two versions is that 010202 encrypts the txid too. 

You can load the file docu.html to see the full docu. 

You can make a full search and view of handles with `crawler2.php?handle=[handle]`. This will show the full handle transaction.

# collisions and privacy

MetaHandles are not collision resistent. There can exist a lot of references on one handle. For example, ["blog"](https://metahandle.net/metahandle.php?handle=blog) already contains six references. In this case MetaHandles are used like a tagging system. 

If you pick a longer handle, like a good password, you can create collision resistency. In this case the handle can be used privately. To prevent others learning about the referenced txid and to protect against someone spamming your handle with other txids, the txid itself can be encrypted too. 

It will be possible to create MetaHandle VersionNumbers which are collision resistent. 

# backward compatibility

I updated MetaHandles from version -0.1 to version 0.0. During this I changed the old BitCom address and the order of op_return fields. Old Handles can be access with the crawler2.php file.

# links

https://metahandle.net/

https://metahandle.net/docu.html
