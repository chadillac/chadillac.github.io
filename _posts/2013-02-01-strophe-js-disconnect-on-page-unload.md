---
layout: post
id: 43030182362
link: http://chad.ill.ac/post/43030182362/strophe-js-disconnect-on-page-unload
slug: strophe-js-disconnect-on-page-unload
date: Wed Feb 13 2013 14:37:00 GMT-0800 (PST)
publish: 2013-02-013
tags: 
title: Strophe.js -> disconnect on page unload
---
{% include JB/setup %}


Strophe.js -> disconnect on page unload
=======================================

**UPDATE: I deleted my outdated repos, Strophe.js has been updated to
support this out of the box now.  The below code still shows how to
properly apply this functionality and has been updated to support the
default Strophe lib.**

There are a few discussions online regarding this procedure and most of
them are misleading, incorrect, or wrong.  To reliably kill a jabber
connection using Strophe.js you’ll need to force
a synchronous (blocking) connection and run through the disconnect
steps.  A couple important things to note here that most discussions
seem to skip over.  Strophe doesn’t natively
support synchronous connections.  Another thing I see is people saying
you should set the sync flag before calling the flush method. My testing
basically came to the conclusion we should flush the connection with an
async call, but should switch to a synchro call immediately before
issuing the disconnect.  If you enable synchro before running flush your
browser session will become unresponsive… for a while.

~~**Step 1: **patch Strophe to support synchronous connections~~

~~[github
diff](https://github.com/chadillac/strophejs/commit/e484a792a402a24d21aa9bc205b62fa18b60d69f)~~

**Step 2: **setup your onunload handler

jQuery

    $(window).bind('unload', function(){
         StropheConnection.flush();
         StropheConnection.options.sync = true;
         StropheConnection.disconnect();
    });

Vanilla JS

    window.onunload = function() {
        StropheConnection.flush();
        StropheConnection.options.sync = true;
        StropheConnection.disconnect();
    };

