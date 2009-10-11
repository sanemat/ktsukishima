<?php set('title', 'limonadeダウンロードからhello world');?>
<h1>limonadeダウンロードからhello world</h1>

<ul>
<li>limonadeをダウンロードする</li>
<li>動作確認</li>
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
