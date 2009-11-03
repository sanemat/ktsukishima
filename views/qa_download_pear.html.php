<?php set('title', 'PEARをダウンロード');?>
<h1>PEARをダウンロード</h1>

<ul>
<li><a href="#pear-dream">PEAR理想</a></li>
<li><a href="#pear-real">PEAR現実</a></li>
<li><a href="#pear-install">PEARインストール・アップグレード</a></li>
</ul>

<h2><a name="pear-dream" id="pear-dream">PEAR理想</a></h2>
<p>アプリごとにPEARのライブラリをインストール、バージョン管理、更新したい</p>

<h2><a name="pear-real" id="pear-real">PEAR現実</a></h2>
<p>めんどい</p>
<p>やりかたはある<br />
<a href="http://www.trekdevel.net/archives/57">PEARパッケージをアプリケーションごとにインストール ? trekdevel</a><br />
<a href="http://iteman.jp/blog/2009/04/pear-1.html">プロジェクトローカルな PEAR 環境を構築する | ITEMAN Blog - アイテマンブログ</a><br />
<a href="http://ethna.jp/ethna-document-dev_guide-pearlocal.html">Ethna - PHPウェブアプリケーションフレームワーク</a>
</p>
<p>デプロイするアプリにはライブラリのバージョンを固定する。<br />
開発環境でpearコマンドたたいてファイルを用意して、それをデプロイ用にcpしてくる。わりきり。バージョン管理・更新は不能。
</p>
<h2><a name="pear-install" id="pear-install">PEARインストール・アップグレード</a></h2>
<p>
開発サーバ環境内にてpearコマンドでガツンと必要ファイルを持ってくる。<br />
以下pearコマンド自体はある場合想定。
</p>
<p>
<pre>
<code>
# pear search pear
WARNING: channel "pear.php.net" has updated its protocols, use "channel-update pear.php.net" to update
# pear channel-update pear.php.net
# pear search pear
Package                              Stable/(Latest)        Local
PEAR                                 1.9.0/(1.9.0 stable)   1.4.9 PEAR Base System
# pear upgrade pear
//依存関係が円環状でアップグレードできないので
//強制アップグレード
# pear upgrade --force pear

//サーバに入ったPEAR.phpをコピー
$ cp /usr/share/pear/PEAR.php vender/.
</code>
</pre>
</p>
<p>vendor/PEAR.php に準備完了</p>
<p>
limonadeの場合はconfigure()でpear置くところにpathを通しておく
<pre>
<code>
function configure()
{
  option( 'root_dir', dirname( __FILE__ ) . '/..' );
  option( 'vendor_dir', option( 'root_dir' ).'/vendor/' );
  set_include_path( option( 'vendor_dir' ) . PATH_SEPARATOR . get_include_path() );
}
</code>
</pre>
</p>
<p>
<a href="<?=url_for('/');?>">how_to_start_limonadeに戻る</a>
</p>
