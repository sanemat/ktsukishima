<?php set('title', 'limonadeダウンロードからhello world');?>
<h1>limonadeダウンロードからhello world</h1>

<ul>
<li><a href="#download-limonade">limonadeをダウンロードする</a></li>
<li><a href="#file-position">ファイル構成</a></li>
<li><a href="#do-well">動作確認</a></li>
<li><a href="#move-and-set">ドキュメントルートの上に移動</a></li>
</ul>

<h2><a name="download-limonade" id="download-limonade">limonadeをダウンロードする</a></h2>
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
<pre>
<code>
$ cd ~
$ git clone git://github.com/sofadesign/limonade.git limonade
$ cd limonade/
$ git checkout origin/0.4
</code>
</pre>
</p>
<h2><a name="file-position" id="file-position">ファイル構成</a></h2>
<pre>
<code>
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
</code>
</pre>
<h2><a name="do-well" id="do-well">動作確認</a></h2>
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
<h2><a name="move-and-set" id="move-and-set">ドキュメントルートの上に移動</a></h2>
<p>
必要なファイルはLICENSE, AUTHORS, lib/limonade.php だけなので、こんな感じに整理した。
</p>
<pre>
<code>
|-- lib
|   |-- AUTHORS-limonade
|   |-- LICENSE-limonade
|   `-- limonade.php
|-- public
|   |-- index.php
|   `-- sample.css
|-- vendor
`-- views
    `-- top_page.html.php
</code>
</pre>
<p>
ディレクトリ構成<br />
libにlimonade、publicを公開環境に、viewsにテンプレートを入れて、vendorにPEARなど別ライブラリを入れる想定<br />
AUTHORSをAUTHORS-limonadeに、LICENSEをLICENSE-limonadeにそれぞれリネーム。<br />
</p>
<p>
$ view public/index.php
</p>
<pre>
<code>
&lt;?php
# Loading limonade framework
require_once dirname( __FILE__ ) . '/../lib/limonade.php';

# Setting global options of our application
function configure()
{
  option( 'root_dir', dirname( __FILE__ ) . '/..' );
  option( 'views_dir', option( 'root_dir' ).'/views/' );
  option( 'lib_dir', option( 'root_dir' ).'/lib/' );
  option( 'vendor_dir', option( 'root_dir' ).'/vendor/' );
  option( 'public_dir', option( 'root_dir' ).'/public/' );
  set_include_path( option( 'vendor_dir' ) . PATH_SEPARATOR . get_include_path() );

}

dispatch('/', 'hello_world');
  function hello_world()
  {
    return "Hello world!";
  }

run();
</code>
</pre>
<p>
こんなかんじで<br />
Hello world!
</p>
<p>
<a href="<?=url_for('/');?>">how_to_start_limonadeに戻る</a>
</p>
