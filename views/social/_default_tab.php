<?php

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use yii\helpers\Html;

FacebookSession::setDefaultApplication('786148194768358','48bccf8788f4a4d324f398f8043becec');

$helper = new FacebookRedirectLoginHelper(Yii::$app->request->getAbsoluteUrl());

try {
    if ( isset( $_SESSION['access_token'] ) ) {
        // Check if an access token has already been set.
        $session = new FacebookSession( $_SESSION['access_token'] );
    } else {
        // Get access token from the code parameter in the URL.
        $session = $helper->getSessionFromRedirect();
    }
} catch( FacebookRequestException $ex ) {

    // When Facebook returns an error.
    print_r( $ex );
} catch( \Exception $ex ) {

}

if (isset($session)) {
    // Logged in
    try {

        $_SESSION['access_token'] = $session->getToken();

        echo 'Successfully logged in!';

        $me = (new FacebookRequest(
            $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());

        echo 'Name: ' . $me->getName();

    } catch (FacebookRequestException $e) {
        // The Graph API returned an error
        echo $e;
    } catch (\Exception $e) {
        // Some other error occurred
        echo $e;
    }
} else {
    $loginUrl = $helper->getLoginUrl();
    echo Html::a('Facebook Login', $loginUrl, ['class'=>'btn btn-primary']);
}


/*
$social = Yii::$app->getModule('social');
// Render the Login button
$url = Yii::$app->request->getAbsoluteUrl(); // or any absolute url you want to redirect
$helper = $social->getFbLoginHelper($url);
$loginUrl = $helper->getLoginUrl();
echo Html::a('Facebook Login', $loginUrl, ['class'=>'btn btn-primary']);

// in your other action that processes the login
// use the output from the helper
$helper = $social->getFbLoginHelper($url); // the same url
$session = $social->getFbSession(['source'=>$helper]); // do anything with this session now

mail('ruben@infoweb.be', __FILE__ . ' => ' . __LINE__, var_export($session, TRUE));
mail('ruben@infoweb.be', __FILE__ . ' => ' . __LINE__, 'test');
if ($session) {
    // for example get the graph user object for current user
    $user = $social->getFbGraphUser($session);
    echo 'User is ' . $user->getName();
}

*/
?>
<div class="tab-content default-tab">
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

</div>