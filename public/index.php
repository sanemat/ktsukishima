<?php
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

# Setting code that will be executed before each controller function
function before()
{
  require_once 'Net/UserAgent/Mobile.php';
  option( 'agent', Net_UserAgent_Mobile::factory() );
  
  require_once 'Text/Pictogram/Mobile.php';
  $picObject = Text_Pictogram_Mobile::factory( 'docomo', 'utf-8' );
  set( 'emoji', $picObject->getFormattedPictogramsArray() );

  layout( 'layout.default.html.php' );

}

# Setting code that will be executed after each controller function
function after( $output )
{
  
  if( option( 'agent' )->isDoCoMo() ){
    $output = after_render_docomo( $output );
  }
  elseif( option( 'agent' )->isSoftBank() ){
    $output = after_render_softbank( $output );
  }
  elseif( option( 'agent' )->isEZweb() ){
    $output = after_render_au( $output );
  }
  else{
    $output = after_render_pc( $output );
  }

  return $output;
}

function after_render_docomo($output)
{
  require_once 'Text/Pictogram/Mobile.php';
  $content_type = 'application/xhtml+xml; charset=Shift_JIS';

  $output = str_replace( '%%%encoding%%%', 'Shift_JIS', $output );
  $output = str_replace( '%%%content_type%%%', $content_type, $output );
  

  $output = mb_convert_encoding( $output, 'SJIS-WIN', 'UTF-8' );

  require_once 'HTML/CSS/Mobile.php';
  try {
      $parser = HTML_CSS_Mobile::getInstance();
      $output = $parser->apply($output);
  } catch (Exception $e) {
      halt( HTTP_FORBIDDEN, "An error occured while dispatch page " . h( $e ) );
  }
  $emoji = Text_Pictogram_Mobile::factory( 'docomo', 'sjis' );
  $output = $emoji->replace( $output );
  
  if( !headers_sent() ) header( "Content-Type: {$content_type}" );
  return $output;
}

function after_render_softbank($output)
{
  require_once 'Text/Pictogram/Mobile.php';
  $content_type = 'text/html; charset=UTF-8';
  
  $output = str_replace( '%%%encoding%%%', 'UTF-8', $output );
  $output = str_replace( '%%%content_type%%%', $content_type, $output);

  $emoji = Text_Pictogram_Mobile::factory( 'softbank', 'utf-8' );
  $output = $emoji->replace( $output );
  
  if( !headers_sent() ) header( "Content-Type: {$content_type}" );
  return $output;
}

function after_render_au($output)
{
  require_once 'Text/Pictogram/Mobile.php';
  $content_type = 'text/html; charset=Shift_JIS';
  
  $output = str_replace( '%%%encoding%%%', 'Shift_JIS', $output );
  $output = str_replace( '%%%content_type%%%', $content_type, $output);
  
  $output = mb_convert_encoding( $output, 'SJIS-WIN', 'UTF-8' );
  
  $emoji = Text_Pictogram_Mobile::factory( 'au', 'sjis' );
  $output = $emoji->replace( $output );
  
  if( !headers_sent() ) header( "Content-Type: {$content_type}" );
  return $output;
}

function after_render_pc($output)
{
  require_once 'Text/Pictogram/Mobile.php';
  $content_type = 'text/html; charset=UTF-8';
  
  $output = str_replace( '%%%encoding%%%', 'UTF-8', $output );
  $output = str_replace( '%%%content_type%%%', $content_type, $output);
  
  $emoji = Text_Pictogram_Mobile::factory( null, 'utf-8' );
  $output = $emoji->replace( $output );
  
  if( !headers_sent() ) header( "Content-Type: {$content_type}" );
  return $output;
}

# Defining routes and controllers
# matches GET /
dispatch( '/', 'top_page' );
  function top_page()
  {
    return render( 'top_page.html.php' );
  }

# matches GET /page
dispatch( '/:page', 'question_page' );
  function question_page()
  {
    $page_name = params( 'page' );
    $file_name = 'qa_' . $page_name . '.html.php';
    if( preg_match( '/^[\w-\.]+$/D', $file_name ) !== 1 ){
      halt( HTTP_FORBIDDEN, "An error occured while dispatch page " . h( $file_name ) );
    }
    elseif(!file_exists( file_path( option('views_dir'), $file_name ) ) ){
      halt( HTTP_NOT_FOUND, "An error occured while dispatch page " . h( $file_name ) );
    }

    return render( $file_name );
  }


# Running the limonade app
run();
