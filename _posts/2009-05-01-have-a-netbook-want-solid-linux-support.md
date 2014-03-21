---
layout: post
id: 113448980
link: http://chad.ill.ac/post/113448980/have-a-netbook-want-solid-linux-support
slug: have-a-netbook-want-solid-linux-support
date: Tue May 26 2009 15:48:34 GMT-0700 (PDT)
publish: 2009-05-026
tags: 
title: have a Netbook?... want solid Linux support?...
---
{% include JB/setup %}


have a Netbook?... want solid Linux support?...
===============================================

I currently have an Asus Eee PC (1002ha) and to say the least am not an
avid Windows fan.  Since the day I unpackaged this puppy I have been on
a quest to find the best OS I could for the lil guy.  So far I’ve ran
EasyPeasy and OS X (needs drivers sadly otherwise this would have never
been written) and looked into running Moblin (although I must admit I
never installed it).  Long story short EasyPeasy was my distro of
choice.

Recently 9.04 went stable and I had heard good things but after looking
over the EasyPeasy forums decided not to upgrade.  Apparently it was
breaking a lot of stuff and 8.10 was running solid enough to keep me
content.

Over memorial day weekend I upgraded my desktop (8.10) to 9.04 and
bricked the box so I ventured over the Ubuntu.com to get a fresh 9.04
install disk.  After doing a clean install the system was unstable and
Firefox was a mess.  So I decided to check out Ubuntu.com again to see
if any others were reporting issues or if I just had a botched install. 
That’s when I noticed it… 9.04 Netbook Remix Edition!  I’m not sure how
I missed this memo but seriously wtf!?  After looking over the wiki and
confirming that the 1000h models were running fairly solid I was sold.

I downloaded their .img file threw it on my thumb drive using my Windows
machine (9.04 wasn’t working yet) and plugged that puppy in.  The
install was painless and fast and I was up and running in no time.  On
the Ubuntu forums I had seen some issues of people reporting failures
coming out of “sleep mode/stand by” and another user mentioned on their
non-netbook that enabling “Effects” (and inturn upping the vid drivers)
fixed the problem.  Now this is what shocked me… even on my 1002ha I was
able to enable “Extra” (wobbly windowns, drop shadows, fading menus… the
whole 9 baby!) under the effects panel
(System-\>Preferences-\>Appearance-\>Visual Effects) and not only did it
work… it worked well… damn well.

I had never expected the Compiz stuff to be so snappy on such low end
video hardware (Intel Integrated 1.6Ghz Atom & 2 gigs of RAM) but it
is!  One of my biggest pet peeves with my old EasyPeasy install were the
hoops you’d have to jump through to disable “Tap to Click”.  I’d read
over tutorials… borked some xorg configs and still because of the
“special” touchpad they used on the 1002ha (multitouch … some random
vendor) I wasn’t able to get it to work properly.  With 9.04 Netbook
Edition it was as simple as unchecking a box in mouse preferences!

If you’re running EasyPeasy (love you guys, but sorry) I HIGHLY
RECOMMEND you go ahead and grab the new official Ubuntu netbook build
(link at the end of the article) and get it on your Eee PC A.S.A.P.  I’m
one very happy camper now that my lil guy has all the bells and
whistles.  From my testing so far multitouch works, web cam works, sound
works, function keys (brighness, volume, etc) all work (the mute button
didn’t work under EasyPeasy)!

Now these next parts are mere speculation (as when you’re happy with a
piece of software you tend to be a touch biased) and I haven’t tested
these claims thoroughly but the machine feels faster, battery life seems
to have improved, Flash (a known resource hog on all Linux boxes) seems
to even perform better (sudo apt-get install flashplugin-nonfree).

Hope this helps push a couple of other curious netbook owners over the
edge and helps them take the plunge!

Ubuntu Netbook Edition :
[http://www.ubuntu.com/getubuntu/download-netbook](http://www.ubuntu.com/getubuntu/download-netbook)

