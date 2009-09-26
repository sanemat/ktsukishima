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

}

# Setting code that will be executed before each controller function
function before()
{
  layout( 'layout.default.html.php' );
}

# Setting code that will be executed after each controller function
function after($output)
{
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
