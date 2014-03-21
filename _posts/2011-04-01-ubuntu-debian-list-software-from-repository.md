---
layout: post
id: 4820221551
link: http://chad.ill.ac/post/4820221551/ubuntu-debian-list-software-from-repository
slug: ubuntu-debian-list-software-from-repository
date: Thu Apr 21 2011 17:10:01 GMT-0700 (PDT)
publish: 2011-04-021
tags: 
title: Ubuntu / Debian - List software from repository
---
{% include JB/setup %}


Ubuntu / Debian : List software from repository
===============================================

This will list packages coming from a specific repository

    grep <repository_name> /var/lib/apt/lists/* | grep tar | cut -d' ' -f4 | sort -u

Example

    $ grep backbox /var/lib/apt/lists/* | grep tar | cut -d' ' -f4 | sort -u

    aircrack-ng_1.1-1backbox1.debian.tar.gz
    autotools-dev_20100122.1backbox1.tar.gz
    backbox-about_1.2.tar.gz
    backbox-artwork_1.6.tar.gz
    ...

