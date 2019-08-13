# metahandle

MetaHandle is a tool to access onchain content on Bitcoin SV (BSV). Instead of accessing it with a txid, you can reference any content to a human readable handle which is stored onchain. So all you need is to search for your handle to access any file you want.

# dependencies

MetaHandle requires some libraries ... I also put some in asset. It's design is run on bootstrap.

https://github.com/dchest/scrypt-async-js

https://github.com/moneybutton/bsv

https://github.com/ricmoo/aes-js

# documentation

## basic structure

A MetaHandle is a BSV transaction putting a specifically structured content in the OP_RETURN field. The goal is to allow a user to access another transaction id and metadata with any word he choses.

This is the structure of the OP_Return output:

`"s1": "1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU",
"s2": [Hash(handle)],
"s3": [VersionNumber],
"s4": [txid],
"s5" - "sn": [any meta data]`

s1 is the BitCom address of MetaHandle. It is registered, but only filled with documentary content. It allows to identify a handle transaction. 
s2 is the Hash of the Handle. When the user knows the name of the handle, he can search for the hash. This allows to keep a handle private. Currently SHA256 is used, but it can be updated if required.
s3 is the VersionNumber. It defines how a handle has to be dessolved. It's format is 000000. First two digits are the handle type, next two digits the subtype, next two the version number of this handle.
s4 is the id of the transaction which contains the content you want to link to.
s5-sn is for meta data like a title, an description and so on.

## handle types

**010103**: Basic handle.
"s5": E(title, handle): Title of the referenced txid, encrypted with the handle as a password. 
"s6": E(description, handle): Description of the referenced content, encrypted with the handle as a password.

Uses *create_aes_key_extra_light* from encrypt.js


**010202**: Basic handle with encrypted txid and better title/description encryption.\
"s4": E(txid, handle): Encrypts the txid too
"s5": E(title, handle)
"s6": E(description, handle)
"s7": salt

Uses *create_aes_key* from encrypt.js. This requires a salt.

**010303**: Taghandle: A basic handle with up to three tags. Example with three tags
"s5": E(title, handle)
"s6": E(description, handle)
"s7": salt (not really needed here)
"s8": Hash(tag1)
"s9": E(handle, tag1)
"s10": Hash(tag2)
"s11": E(handle, tag2)
"s12": Hash(tag3)
"s13": E(handle, tag3)

Uses *create_aes_key_extra_light* from encrypt.js. To decrypt title and description you need to first decrypt the handle

**010402**: Tag handle with encrypted txid and stronger encryption. Like 010303, but with
"s4": E(txid, handle).

Uses *create_aes_key* from encrypt.js. This requires a salt.

**020102**: Value handle. This handle is only valid if the transaction creating it has an unspent output. Structure is identical with 010103, but it is processed differently when searched.

**020201**: Value handle with encrypted txid. Structure is identical with 010202

**020303**: Value handle with tags. Structure is identical with 010303.

**020402**: Value handle with tags and encrypted txid. Structure is identical with 010402.

**020501**: Exclusive handle. This is a basic handle which is only valid when it has a value of at least 0.1 BSV AND it is the first handle claiming a word. If an exclusive handle is valid no other handle should be shown in the search. It should be the only valid handle for this word. Structure is identical with 010103.

## do a full search of the transaction

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
