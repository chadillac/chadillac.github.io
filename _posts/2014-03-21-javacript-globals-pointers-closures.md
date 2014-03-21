---
layout: post
date: Thur Mar 21 2014
publish: 2014-03-021
tags: [javascript,globals,pointers,crash course]
title: JS pointers, globals, and garbage... gotchas.
---
{% include JB/setup %}

There are plenty of resources out there to learn about these things in depth.  Giving you 
exhaustive detail on these topics isn't the goal of this post.  I want to introduce you to some concepts
that many devs gloss over while learning JS. I think it's important to clear up some 
misconceptions about JS and working in it.  I might do more of these covering more topics in the future 
such as prototypes, polymorphism, closures, etc. Anyway, let's begin.


What are Pointers?
===
Pointers are basically memory locations.  Think of it as a mailing address.  When you mail something
you don't just write a name on the front of an envelope and drop it in the mail, it has no 
reference to where it needs to go.  Memory and variables are kind of the same way, when you create
a new variable in JS you're really communicating with a chunk of memory that is referenced by a pointer.
Keep that in mind going forward.

Garbage.
===
JS doesn't make you manage your own memory or pointers, it does it for you.  All of the creation, passing, 
and cleanup happens in a blackbox, this makes it easy for the developer, but it also introduces confusion.
Remember that a lot of variables in JS are passed by reference, and depending on where that reference occurs
some things might stay in memory even if you can get to them from their origional scope.

Globals.
===
Globals are referenced from everywhere and they change.  When a global thing changes all of it's references
also change. *Not so much*.

     var one = true;
     function two() { this.one = one; };
     var three = new two();
     one = false;
     console.log(three);
     > {one:true}

Okay, so we mapped a global to this object, but when we changed the global it didn't update... that's because
JS made a copy, this wasn't a pass by reference, so the global isn't really all that global here, but check this out.

     var one = {foo:true};
     function two() { this.one = one; };
     var three = new two();
     one.foo = false;
     console.log(three);
     > {one:{foo:false}}
     
So this time we mapped to a global *object* and when it's value changed internally, we caught it...

WTF?!
==== 
When passing around objects and more complex data structures JS doesn't copy raw values, it does a pass by reference,
so what you have is basically the pointer that the global was associated with, since it's not a hard copy but a shared
piece of memory, changes inside of a global object will be reflected in your reference... kinda like how you'd expect
a global to work in the first place.

**but wait, there's more!**

     var one = {foo:true};
     function two() { this.one = one; };
     var three = new two();
     one.foo = false;
     console.log(three.one);
     > {foo:false}, 
     one = null;
     console.log(one);
     > null
     console.log(three.one);
     > {foo:false}

Wat.
====
What happened here was JS in its memory management saw we had a reference to one from another `closure`, rather than 
destroying that reference and reclaiming that memory it allowed it to persist and created a new chunk of memory, then
re-mapped the global one to that memory.  Since our `closured` version still maps to the old memory/data, we still have
complete access to it.

     var one = {foo:true};
     function two() { this.one = one; };
     var three = new two();
     var four = new two();
     one.foo = false;
     console.log(three.one, four.one);
     > {foo:false}, {foo:false}
     one = null;
     console.log(one);
     > null
     console.log(three.one);
     > {foo:false}, {foo:false}
     three.one.foo = 'asdf';
     console.log(three.one, four.one);
     > {foo:'asdf'}, {foo:'asdf'}


