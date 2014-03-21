---
layout: post
id: 69924332733
link: http://chad.ill.ac/post/69924332733/typeerror-cannot-call-method-log-of-undefined-meet
slug: typeerror-cannot-call-method-log-of-undefined-meet
date: Fri Dec 13 2013 16:15:37 GMT-0800 (PST)
publish: 2013-12-013
tags: javascript, console, debugging, smarterconsole, util, inspiredbyfuckit, setitandforgetit
title: TypeError - Cannot call method &quot;log&quot; of undefined meet smarter_console.js
---
{% include JB/setup %}


"TypeError: Cannot call method 'log' of undefined" meet smarter_console.js
==========================================================================

Web developer tools have come a long way over the past 10 years, I
remember writing custom logging and debugging classes that used pop-up
windows and forin loops to inspect objects.  We now have a great suite
of tools in many browsers and we utilize them often.  However some
issues still persist, even with these tools.

Old browsers don’t support them, meaning your console.log call with
generate the fatal error used in the title of this post.  This means
you’ll have to either wrap your interaction calls in a if statement
making sure they exist, or you’ll have to remove or comment them in
production code.  If you remove them in production code, you can’t use
them in production code.  Sometimes it’s handy to have them in a
production environment  the downside obviously being all of your
production .log calls dumping a lot of data to the browser console 100%
of the time when in reality you need it less that 1% of the time.

Facing this little gotcha I decided to write a smarter console
wrapper/shim for dealing with the aforementioned cases and adding
support (not great support, but support) for older browsers.  Also
adding the ability to suppress calls in a production environment and to
enable them at will should you need them.

You can find out more about this lib and it’s use on it’s github page.

[](https://github.com/chadillac/smarter_js_console)[https://github.com/chadillac/smarter\_js\_console](https://github.com/chadillac/smarter_js_console) 

