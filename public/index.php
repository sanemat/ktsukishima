<?php
# Loading limonade framework
require_once dirname( __FILE__ ) . '/../lib/limonade.php';

# Setting global options of our application
function configure()
{
  option( 'root_dir', dirname( __FILE__ ) . '/..' );
#  option( 'public_dir', option('root_dir').'/public/');
  option( 'views_dir', option('root_dir').'/views/');
#  option( 'controllers_dir', option('root_dir').'/controllers/');
  option( 'lib_dir', option('root_dir').'/lib/');
  set_include_path(option('lib_dir') . PATH_SEPARATOR . get_include_path());

}

# Setting code that will be executed before each controller function
function before()
{
  require_once 'Net/UserAgent/Mobile.php';
  option( 'agent', Net_UserAgent_Mobile::factory() );
  
  $encoding = option('encoding');
  $content_type = "application/xhtml+xml; charset={$encoding}";
  if(option('agent')->isDoCoMo()){
    $encoding = 'Shift_JIS';
    $content_type = "application/xhtml+xml; charset={$encoding}";
  }
  elseif(option('agent')->isSoftBank()){
    $encoding = 'UTF-8';
    $content_type = "text/html; charset={$encoding}";
  }
  elseif(option('agent')->isEZweb()){
    $encoding = 'Shift_JIS';
    $content_type = "text/html; charset={$encoding}";
  }
  set('encoding', $encoding);
  set('content_type', $content_type);

  require_once 'Text/Pictogram/Mobile.php';
  $picObject = Text_Pictogram_Mobile::factory('docomo', 'utf-8');
  $emoji = $picObject->getFormattedPictogramsArray();
  set('emoji', $emoji);

  layout( 'layout.default.html.php' );

}

# Setting code that will be executed after each controller function
function after($output)
{
  require_once 'Text/Pictogram/Mobile.php';
  
  if( option('agent')->isDoCoMo() ){
    $output = mb_convert_encoding( $output, 'SJIS-WIN', 'UTF-8');
    $emoji = Text_Pictogram_Mobile::factory('docomo', 'sjis');
    $output = $emoji->replace( $output );
    if( !headers_sent() ) header( 'Content-Type: application/xhtml+xml; charset=Shift_JIS' );
  }
  elseif( option('agent')->isSoftBank() ){
    $emoji = Text_Pictogram_Mobile::factory('softbank', 'utf-8');
    $output = $emoji->replace( $output );
    if( !headers_sent() ) header( 'Content-Type: text/html; charset=UTF-8' );
  }
  elseif( option('agent')->isEZweb() ){
    $output = mb_convert_encoding( $output, 'SJIS-WIN', 'UTF-8');
    $emoji = Text_Pictogram_Mobile::factory('au', 'sjis');
    $output = $emoji->replace( $output );
    if( !headers_sent() ) header( 'Content-Type: text/html; charset=Shift_JIS' );
  }
  else{
    $emoji = Text_Pictogram_Mobile::factory( null, 'utf-8');
    $output = $emoji->replace( $output );
  }

  return $output;
}

# Defining routes and controllers
# matches GET /
dispatch( '/', 'hello' );
  function hello()
  {
    return 'Hello limonade!';
  }

# matches GET /page
dispatch( '/:page', 'question_page' );
  function question_page()
  {
    $page_name = params( 'page' );
    $file_name = 'qa_' . $page_name . '.html.php';
    if( preg_match( '/^[\w-\.]+$/D', $file_name ) !== 1 ){
      halt( HTTP_FORBIDDEN, "An error occured while dispatch page " . h($file_name) );
    }
    elseif(!file_exists( file_path( option('views_dir'), $file_name ) ) ){
      halt( HTTP_NOT_FOUND, "An error occured while dispatch page " . h($file_name) );
    }

    return render( $file_name );
  }


# Running the limonade app
run();
