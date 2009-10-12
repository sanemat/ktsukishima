<?php set('title', 'limonadeダウンロードからhello world');?>
<h1>limonadeダウンロードからhello world</h1>

<ul>
<li>limonadeをダウンロードする</li>
<li>動作確認</li>
<li>ファイル構成</li>
<li>ドキュメントルートの上に移動</li>
</ul>

<h2>limonadeをダウンロードする</h2>
<p>
最新版を<a href="http://github.com/sofadesign/limonade">sofadesign's limonade at master - GitHub</a>から持ってくる。<br />
現在の開発サイクルが<br />
branchの0.4にpush<br />
→ある程度のかたまりでバージョンのtagが切られる<br />
→masterにマージ<br />
なのでbranchの0.4が最新版<br />
ここから持ってくる
</p>
<p>
たとえば: home下のlimonadeディレクトリに展開する
<code>
<pre>
$ cd ~
$ git clone git://github.com/sofadesign/limonade.git limonade
$ cd limonade/
$ git checkout origin/0.4
</pre>
</code>
</p>
<h2>ファイル構成</h2>
<code>
<pre>
$ tree .
.
|-- AUTHORS
|-- CHANGES
|-- LICENSE
|-- LISEZMOI.mkd
|-- README.mkd
|-- TODO
|-- examples
|   |-- example01
|   |   |-- index.php
|   |   `-- public
|   |       |-- soda_glass.jpg
|   |       `-- soda_glass.thb.jpg
|   |-- example02
|   |   `-- index.php
|   |-- index.php
|   `-- urlrewrite
|       |-- htaccess.conf
|       `-- lighttpd.conf
|-- lib
|   |-- limonade
|   |   |-- abstract.php
|   |   |-- assertions.php
|   |   |-- public
|   |   |   |-- css
|   |   |   |   `-- screen.css
|   |   |   `-- img
|   |   |       `-- bg_header.png
|   |   |-- tests.php
|   |   `-- views
|   |       |-- _debug.html.php
|   |       |-- _notices.html.php
|   |       |-- default_layout.php
|   |       `-- error.html.php
|   `-- limonade.php
`-- tests
    |-- all.php
    |-- apps
    |   |-- 00-empty.php
    |   `-- 01-hello_world.php
    |-- data
    |   |-- deer.jpg
    |   |-- empty_text_file.txt
    |   `-- lib0
    |       |-- a.php
    |       |-- b.php
    |       `-- c.php
    |-- file.php
    |-- functional.php
    |-- helpers
    |   `-- show_request_uri.php
    |-- main.php
    |-- output.php
    |-- request.php
    |-- router.php
    `-- tests.php

16 directories, 39 files
</pre>
</code>
<h2>動作確認</h2>
<p>
webサーバからアクセスできるようにする
</p>
<p>
たとえば: $HOME/limonade をlimonade.localhostでアクセスできるようにして<br />
http://limonade.localhost/examples/ にwebブラウザからアクセス<br />
Limonade examplesが出る<br />
example 01 Hello World!をクリック(http://limonade.localhost/examples/example01/)<br />
→Hello world!<br />
?/hello/sanematとパラメータを渡すと(http://limonade.localhost/examples/example01/?/hello/sanemat)<br />
→Limonde first example Hello sanemat!<br />
</p>
