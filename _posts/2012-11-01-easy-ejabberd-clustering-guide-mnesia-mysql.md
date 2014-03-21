---
layout: post
id: 35967173942
link: http://chad.ill.ac/post/35967173942/easy-ejabberd-clustering-guide-mnesia-mysql
slug: easy-ejabberd-clustering-guide-mnesia-mysql
date: Sat Nov 17 2012 21:28:00 GMT-0800 (PST)
publish: 2012-11-017
tags: cluster, clustering, easy, ejabberd, how to, linux, mnesia, mysql, postgres, simple, straight forward, tutorial, howto, guide
title: easy ejabberd clustering guide (mnesia, mysql, &amp; postgres)
---
{% include JB/setup %}


easy ejabberd clustering guide (mnesia, mysql, & postgres)
==========================================================

Ejabberd is a great little XMPP server, however it’s documentation makes
me want to rip my fucking face off.  I have just spent way to long
getting things configured (this is partly due to mysql5 support and 3rd
party modules, dual NIC machines, public dns records… clustering issues
were just icing on the cake) and I’m going to (hopefully) make your life
a little easier.  To get things working properly I pieced together
multiple tutorials and official documentation… which seems absurd
considering the popularity of the ejabberd.  So below are the nitty
gritty details and a helper module I wrote… because inputing mnesia
commands into a debug shell for multiple slave node is… retarded.

**before we begin, I want to point out that if you’re using mysql or
postgres for authentication, offline messaging, etc. it doesn’t really
matter to ejabberd for clustering purposes, although it is important
when joining the cluster (which the official documentation seems to
forget).**

***first things first, let’s configure our master node***

*(we’re assuming at this point you’ve installed ejabberd from source
without a prefix, have it properly configured, and can successfully
connect and message using it)*

* * * * *

**1: shut down your “master node”**

    ejabberdctl stop

**2: edit ejabberdctl.cfg (/etc/ejabberd/ejabberctl.cfg)**

**2.1: change node name:**

    ERLANG_NODE=ejabberd@'master.domain.com'

**2.2: change ip we listen on: (get this from ifconfig)**

*note: look closely, that’s a tuple, don’t use .’s use ,’s*

    INET_DIST_INTERFACE={192,168,10,100}

**3: clear your ejabberd mnesia tables after hostname change**

*note: hostname changes are a pain, it’s easier to just let ejabberd
rebuild the mnesia db’s at startup.*

    rm /var/lib/ejabberd/*

**4: add hostname to /etc/hosts using address and hostname from confg**

    192.168.10.100    master.domain.com

**5: start master node, and make sure it’s running**

    ejabberdctl start

    ejabberdctl status

* * * * *

***now we’ll need to configure our slaves***

*(once again we’re assuming the server is properly installed and
functional as a stand alone server)*

* * * * *

**1: if the server is running, stop it.**

    ejabberdctl stop

**2: update ejabberctl.cfg (/etc/ejabberd/ejabberdctl.cfg**

**2.1: change node name:**

    ERLANG_NODE=ejabberd@'slave1.domain.com'

**2.2: change ip we listen on: (get this from ifconfig)**

*note: look closely, that’s a tuple, don’t use .’s use ,’s*

    INET_DIST_INTERFACE={192,168,10,150}

**3: clear your ejabberd mnesia tables after hostname change**

*note: hostname changes are a pain, it’s easier to just let ejabberd
rebuild the mnesia db’s at startup.*

    rm /var/lib/ejabberd/*

**4: copy .erlang.cookie from “master node”
(/var/lib/ejabberd/.erlang.cookie)**

*note: this is the unique cookie from ejabberd@master.domain.com, not
the one already residing on slave1*

**5: add hostnames to /etc/hosts using address and hostname from confg**

    192.168.10.100    master.domain.com
    192.168.10.150    slave1.domain.com

**6: create and compile easy\_cluster module**

**6.1: go to server binaries folder**

    cd /lib/ejabberd/ebin/

**6.2: create empty module file**

    touch easy_cluster.erl

**6.3: put the following contents in easy\_cluster.erl and save the
file**

[](https://github.com/chadillac/ejabberd-easy_cluster/blob/master/easy_cluster.erl)[https://github.com/chadillac/ejabberd-easy\_cluster/blob/master/easy\_cluster.erl](https://github.com/chadillac/ejabberd-easy_cluster/blob/master/easy_cluster.erl)

**6.4: compile easy\_cluster.erl**

    erlc easy_cluster.erl

**6.5: confirm compilation succeeded**

*note: you should see easy\_cluster.beam in the directory if compilation
was successful*

    ls | grep easy_cluster.beam

**7: start the slave node & confirm it’s running**

    ejabberdctl start

    ejabberdctl status

**8: drop into a debugging session on the live server**

*note: you’ll see a warning message, just hit enter to continue*

    ejabberdctl debug

*note: if you successfully drop a debug console, your prompt will
resemble this*

    Erlang (BEAM) emulator version 5.6.5 [source] [64-bit] [smp:4] [async-threads:0] [hipe] [kernel-poll:true]

    Eshell V5.6.5  (abort with ^G)
    (ejabberd@slave1.domain.com)1>

**9: test to see if we can connect to the node**

*note: at the end of each line we put a . this tells erlang to process
our command*

    easy_cluster:test_node('ejabberd@master.domain.com').

***if “server is reachable” we can continue, if it’s not, make sure you
did ALL of the steps above.***

**10: join the cluster**

    easy_cluster:join('ejabberd@master.domain.com').

**11: suspend your debug session by hitting Ctrl+c Ctrl+c**

**12: you’re done, go drink a beer, you probably need it.**

