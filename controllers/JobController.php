<?php
/**
 * 简单的招聘列表页面
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\services\business\Job;


class JobController extends Controller
{

    public $layout = 'mui_layout';

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        //读取当前页面的部分招聘信息
        $data = Job::GetList();
       return $this->render('index', ['joblist' => $data]);
    }

    public function actionDetail()
    {
        if (!isset($_GET['id'])) {
            return $this->render('warning', ['msg' => '参数错误']);
        }
        $id = (int)$_GET['id'];
        $data = Yii::$app->sqlite->createCommand("SELECT * FROM `job_list` WHERE id = '" . $id . "'")->queryAll();
        $data[0]['job_desc'] = str_replace(PHP_EOL, '<br>', $data[0]['job_desc']);
        if (empty($data)) {
            return $this->render('warning', ['msg' => '参数错误', 'go' => Url::to(['/job'])]);
        }
        $jobList = Job::getMore($id);
        return $this->render('detail', ['data' => $data, 'joblist' => $jobList]);
    }

    //列表
    public function actionList()
    {
        return $this->render('list', ['request' => Url::to(['job/get-page'])]);
    }

    //获取分页
    public function actionGetPage()
    {
        $pageSize = 20;
        $request = Yii::$app->request->post();
        $page = isset($request['page']) ? (int)$request['page'] : 1;
        $joblist = Job::getListInPage($page, $pageSize);
        $count = Job::getCont();
        $totalPage = ceil($count / $pageSize);
        $data = array('code' => '200', 'msg' => 'ok', 'data' => $joblist, 'page' => $totalPage);
        return $this->asJson($data);
    }

    public function actionSearch()
    {
        return $this->render('search' , ['msg' => '暂未开通' , 'go' => Url::to(['/job'])]);
    }

    public function actionRyanAdmin()
    {
        return $this->render('ryan-admin', ['delUrl' => Url::to(['job/ryan-del']), 'request' => Url::to(['job/get-page'])]);
    }


    public function actionRyanDel()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');
        if (is_null($id) || !is_numeric($id)) {
            return $this->asJson(array('message' => '参数错误', 'code' => 400));
        }
        try{
            $res = Job::Del($id);
            return $this->asJson(array('message' => 'ok', 'code' => 200, 'id' => $id));
          }catch(\Exception $e){
            return $this->asJson(array('message' => $e->getMessage(), 'code' => 500, 'id' => $id));
        }

    }


    /**
     * 地图
     */
    public function actionMap()
    {
        return $this->render('map');
    }


    /**
     * curl访问页面测试
     */
    public function actionCurl()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $url = $request->post('url');
            try {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_COOKIESESSION, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $body = curl_exec($ch);
                curl_close($ch);
                return $this->render('curl', ['body' => $body]);
            } catch (\Exception $e) {
                return $this->render('curl', ['err' => $e]);
            }
        } else {
            return $this->render('curl');
        }


    }

}