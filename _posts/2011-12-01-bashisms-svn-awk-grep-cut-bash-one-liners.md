---
layout: post
id: 14286989688
link: http://chad.ill.ac/post/14286989688/bashisms-svn-awk-grep-cut-bash-one-liners
slug: bashisms-svn-awk-grep-cut-bash-one-liners
date: Thu Dec 15 2011 17:15:00 GMT-0800 (PST)
publish: 2011-12-015
tags: 
title: Bash'isms (SVN+Awk+Grep+Cut+Bash one liners)
---
{% include JB/setup %}


Bash'isms (SVN+Awk+Grep+Cut+Bash one liners)
============================================

A couple bash 1 liners I threw together recently that I’ve found to come
in very handy so I thought I’d share.

The back story is simple, yearly reviews, talk about what you’ve done,
yadda yadda yadda.  Well, I don’t remember honestly. I’ve done A LOT.
 That’s not going to fly in a serious meeting with ["The
Bobs"](http://www.youtube.com/watch?v=2SoWNMNKNeM).  So I needed a way
to look over my years work, as a refresher of little and big projects
alike.  No problem SVN to the rescue… but our SVN has a lot of
developers, and several commits per day of new features, bug fixes,
tweaks, etc. After consulting the SVN docs I was pretty shocked to find
no way to pull logs based on the user submitting said changes… one would
expect something along the lines of:

    svn log -uchad

And one would be wrong in assuming such a feature exists.  Some Google
time turned up convoluted and down right ugly solutions.  I decided to
have a go at it with my bash-fu… for practice and profit.  Below is an
easy way using a couple common \*nix tools to get the info you want fast
and easy. In the following examples data you’ll need to replace will be
wrapped in %’s with example data in []’s (e.g. %username[chad]%)

**Get all svn commits for a given username:**

    svn log | grep '| %username[chad]%' | cut -d' ' -f1 | awk '{print "svn log -"$1}' | bash 

**Get all svn commits for a given username in a year/month/day:**

    svn log | grep %date[YYYY-MM-DD]% | grep '| %username[chad]%' | cut -d' ' -f1 | awk '{print "svn log -"$1}' | bash 

**Get all modified files for a users commited for a day/week/etc.:**

    svn log | grep %date[YYYY-MM-DD]% | grep '| %username%' | cut -d' ' -f1 | awk '{print "svn log -v -"$1}' | bash | grep %files['/trunk']%

