---
layout: post
id: 256284338
link: http://chad.ill.ac/post/256284338/flex-security-sandbox-violation
slug: flex-security-sandbox-violation
date: Tue Nov 24 2009 17:31:31 GMT-0800 (PST)
publish: 2009-11-024
tags: 
title: Flex Security sandbox violation
---
{% include JB/setup %}


Flex Security sandbox violation
===============================

Working in Flex and/or Flash you often run into the same problem many
times and forget the easy and common sense answer.  Security sandbox
violations for me is one of those cases.

Googling for answers is usually fruitless and starts talking about
server side crossdomain.xml policy files and meta data.  These are
important in the long run but what about when they’re in place and
you’re just testing new client side code.  Well I’ve done this a few
times now and EVERY time I do it I completely forget the quick and easy
work around.  So if you’ve looked into the crossdomain.xml tutorials and
everything is ship shape but you still can’t test from your local
machine I suggest doing the following.

​1. right click on any .swf file

​2. choose “Settings…”

​3. Privacy Tab

​4. “Advanced…” button

this will load up an Adobe page that allows you to change and tweak
global settings in Flash player that can only be done so there.  It’s
pretty clutch.

​5. click “Global Security Settings Panel” on the left side menu

​6. click “Edit Locations…”

​7. click “Add Locations…”

​8. in the prompt window that comes up put /

​9. click confirm

​10. change radio button to “Always allow”

Wahlah… your local .swf files are now null and void as far as cross
domain sandbox rules are concerned in the world of Flash player.

What you’ve essentially done here is tell Flash Player to ignore
security rules for any files in your root files system.  If you’re
security minded and run a lot of .swf files that you don’t trust locally
I wouldn’t recommend this setting as it completely overrides security
measures put in place to protect you.  You can also use the “browse”
functionality to pick specific files which realistically is much safer
from a security stand point.  I myself don’t worry about it because I
don’t store any .swf files locally when it boils down to it.

