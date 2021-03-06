<?php

namespace app\components;


use yii\base\Behavior;
use yii\console\Controller;
use yii\helpers\Url;

class AccessBehavior extends Behavior
{
    /**
     * @var string Yii route format string
     */
    protected $redirectUri;
    /**
     * @var array Routes which are allowed to access for none logged in users
     */
    protected $allowedRoutes = [];
    /**
     * @var array Urls generated from allowed routes
     */
    protected $allowedUrls = [];
    /**
     * @param $uri string Yii route format string
     */
    public function setRedirectUri($uri)
    {
        $this->redirectUri = $uri;
    }
    /**
     * Sets allowedRoutes param and generates urls from defined routes
     * @param array $routes Array of allowed routes
     */
    public function setAllowedRoutes(array $routes)
    {
        if (count($routes)) {
            foreach ($routes as $route) {
                $this->allowedUrls[] = Url::to($route);
            }
        }
        $this->allowedRoutes = $routes;
    }
    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->redirectUri)) {
            $this->redirectUri = \Yii::$app->getUser()->loginUrl;
        }
    }
    /**
     * Subscribe for event
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }
    /**
     * On event callback
     */
    public function beforeAction()
    {
        if (\Yii::$app->getUser()->isGuest &&
            \Yii::$app->getRequest()->url !== Url::to($this->redirectUri) &&
            !in_array(\Yii::$app->getRequest()->url, $this->allowedUrls)
        ) {
            \Yii::$app->getResponse()->redirect($this->redirectUri)->send();
        }
    }

}