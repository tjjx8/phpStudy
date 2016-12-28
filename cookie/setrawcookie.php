<?php

// $str = '123_,; abc';

// setcookie('test', $str, time()+60, '/');
// // value值:123_%2C%3B%20abc

// setrawcookie('test1', $str, time()+60, '/');
// // value值:123_,; abc
// echo rawurlencode($str);exit;
// setrawcookie('test2', rawurlencode($str), time()+60, '/');
// // value值:123_%2C%3B%20abc


setrawcookie("phpor", "hello;world");
print_r($_COOKIE);

/*
结果：


Warning: Cookie values can not contain any of the folllowing ',; \t\r\n\013\014' (hello;world) in D:\Program\www\a.php on line 2

结论：

1. 设置cookie时，cookie的value是需要urlencode的； 毕竟http协议中cookie的设置如下：


Set-Cookie: phpor=hello%3Bworld; expires=Thu, 01-Jan-1970 00:01:40 GMT; path=/
1
Set-Cookie: phpor=hello%3Bworld; expires=Thu, 01-Jan-1970 00:01:40 GMT; path=/
cookie的属性之间使用”;” 来分隔的，如果cookie的value中含有 “;” ，自然也不会当做value的一部分的

2. PHP对于上行的cookie也是做urldecode的（尽管多个cookie之间的分隔符不是”&”）

3.  从协议层不难看出，cookie名字也是不能有特殊字符的，就像value中不能函数特殊字符一样

注意：

PHP中setcookie对value的编码使用的是urlencode：

1. urlencode对有些字符是不编码的，有些时候会带来不必要的麻烦

2. urlencode会将空格编码为’+’，而有些解码函数如JS中的 unescape 、decodeURIComponent 并不会将 ‘+’ 解码为空格的，于是cookie中的’hello world’，使用JS从cookie中取出后就会成为’hello+world’

针对上面两个问题，建议：

1. 自己对cookie值做rawurlencode，使用setrawcookie来设置cookie

2. 自己对cookie值做rawurlencode，使用header函数来set-cookie

 */