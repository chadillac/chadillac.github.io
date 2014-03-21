---
layout: post
id: 90125656
link: http://chad.ill.ac/post/90125656/flex-3-textarea-buffering-trimming
slug: flex-3-textarea-buffering-trimming
date: Thu Mar 26 2009 14:10:58 GMT-0700 (PDT)
publish: 2009-03-026
tags: 
title: Flex 3 textarea buffering/trimming
---
{% include JB/setup %}


Flex 3 textarea buffering/trimming
==================================

While working on a recent project (Flash based video chat application)
we’d start to see serious performance degredation the longer the app
ran.  Long story short we discovered the chat rooms Textarea was the
primary culprit.  Since we continued to append new text the memory foot
print for that single component was enough to make the whole app slow to
a crawl.

We tried a few different approaches at first.  Some good and some
horrible.  One involved RegExp objects and character counts with
substrings… as you can (or can’t) imagine it was a disaster both from a
memory and system resources stand point but also from a “wtf this isn’t
working reliably” point as well.

After a little more thought I came up with this little tactic here… as I
write this I have bots spamming a test room.  We’re at 7.5 million
messages recieved and still going strong! ;)

    public function add_chat_text(chat_text:String):void
    {
        chat_text_buffer.push(chat_text);
                
        if(chat_text_buffer.length >= 100)
        {
            var keep_offset:int = (chat_text_buffer.length - 100); 
            chat_text_buffer = chat_text_buffer.splice(keep_offset);
        }
                
        chatText.htmlText = chat_text_buffer.join("\n");
        callLater(scrollChatArea);
    }

Explination:

chat\_text\_buffer is an Array that we treat as a buffer of messages
recieved.  When a new message event comes in from the server once we’ve
gone through and gotten it formated with username, HTML elements, etc. 
We call add\_chat\_text passing in the message.

Once inside the function we add the new message to the
chat\_text\_buffer Array via a push.  The next steps are the imporant
ones.  Once we’ve added the new message to the tail end of the array via
the push we check against it’s length.  If the length exceeds the
maximum chat messages we wish to display we subtract our desired message
amount from the overall length of the Array.  This will return an
integer that we’ll use as a kind of reference to the first index we want
to keep. (e.g. length = 150… 150 - 100 = 50 … so now we know we need to
start taking elements at index 50 and trash 0-49)

Now that we have our starting index we’ll need to trash the rest of the
Array.  Using Array.slice we can easily achieve this (what a wonderful
method).  By passing in our index that we calculated previously.

Once we’ve gotten the subset of data from the Array and trashed the rest
all that’s left is to convert it into String format and shove it in the
Textarea.  I accomplish this with a simple join and making the value
seperator be a “\\n” (new line).  Once we’ve done that we just replace
the Textareas HTMLtext value with our new chat buffer.

PROTIP: K.I.S.S.

