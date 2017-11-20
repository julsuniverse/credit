<?php
namespace src\services\networks;
use src\entities\User;
use src\repositories\UserRepository;
use src\services\auth\SignupService;
use Yii;
use yii\helpers\Url;

class FbAuth
{
    public $client_id;
    public $client_secret;
    public $redirect_uri;

    private $signupService;
    private $users;

    CONST NETWORK_NAME = 'fb';
    public function __construct(SignupService $signupService, UserRepository $users)
    {
        $this->signupService = $signupService;
        $this->users = $users;

        return $this;
    }

    /**
     * @param $alias
     */
    public function setUp($alias)
    {
        $this->client_id='103284087115763'; // ID приложения
        $this->client_secret = 'c2b746fbf498648592187763cb494642'; // Защищённый ключ
        $this->redirect_uri = Url::home(true).'company/auth?ufrom=fb_'.$alias; // Адрес сайта
    }

    /**
     * @return string
     */
    public function getHref() : string
    {
        $url = 'https://www.facebook.com/dialog/oauth';
        $params = array(
            'client_id'     => $this->client_id,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => 'code',
            'scope'         => 'email,user_friends,user_photos,user_actions.music'
        );
        return $url.'?'.urldecode(http_build_query($params));
    }
    public function getToken($code)
    {
        $params = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $code,
            'redirect_uri' => $this->redirect_uri
        );
        $url = 'https://graph.facebook.com/oauth/access_token';
        $tokenInfo = null;
        $tokenInfo= json_decode(file_get_contents($url . '?' . http_build_query($params)), true);
        return $tokenInfo;
    }
    public function getUserInfo($tokenInfo)
    {
        if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
            $params = array('access_token' => $tokenInfo['access_token']);

            $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?fields=id,email,name,picture&' . urldecode(http_build_query($params))), true);
            if (isset($userInfo['id'])) {
                $userInfo = $userInfo;
                $result = true;
            }
        }
        $userInfo['picture']=$userInfo['picture']['data']['url'];
        return $userInfo;
    }
    public function getPhotos($token)
    {
        if (isset($token['access_token'])) {
            $params = array(
                'access_token' => $token['access_token']
            );
            $userInfo  = json_decode(file_get_contents('https://graph.facebook.com/me/photos' . '?type=tagged&' . urldecode(http_build_query($params))), true);
        }
        return count($userInfo['data'])+1;
    }
    public function getFriends($token)
    {
        if (isset($token['access_token'])) {
            $params = array(
                'access_token' => $token['access_token']
            );
            $userInfo  = json_decode(file_get_contents('https://graph.facebook.com/me/friends' . '?fields=total_count&' . urldecode(http_build_query($params))), true);
        }
        return $userInfo['summary']['total_count'];
    }

    public function getData($code)
    {
        $token = $this->getToken($code);
        $userInfo=$this->getUserInfo($token);
        $friends=$this->getFriends($token);
        $photos=$this->getPhotos($token);
        return array_merge($userInfo, ['photos'=>$photos], ['friends'=>$friends]);
    }

    public function loginUser($code)
    {
        $userInfo = $this->getData($code);
        if (isset($userInfo))
        {
            $findUser = $this->users->findUserWithNetwork($userInfo, self::NETWORK_NAME);
            if($findUser)
            {
                Yii::$app->user->login($findUser);
                return  $userInfo;
            }
            else
            {
                $user = $this->signupService->networkSignup($userInfo, self::NETWORK_NAME);
                Yii::$app->user->login(User::findByUsername($user->username));
                return $userInfo;
            }
        }
    }

}