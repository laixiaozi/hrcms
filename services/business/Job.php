<?php

namespace app\services\business;

use Yii;
use yii\helpers\Url;
use app\services\business\common\Sqlite;

class Job
{
    public static function addJob($data)
    {
        try {
            return Sqlite::execute("INSERT INTO job_list (job_title ,job_desc ,job_status ,job_add_time) VALUES ('" . $data['title'] . "','" . $data['body'] . "','1','" . date('Y-m-d H:i:s') . "')");
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * 返回最新列表
     */
    public static function GetList()
    {
        $JobList = Sqlite::query("SELECT * FROM job_list ORDER BY id DESC limit 30");
        return self::ListFormat($JobList);
    }

    //获取当前信息的前后10条数据
    public static function getMore($id)
    {
        $start = $id - 3 > 0 ? $id - 3 : 0;
        $end = $id + 3;
        $sql = "SELECT * FROM job_list WHERE id <> {$id} AND  id >= " . $start . ' AND id <=' . $end;
        $JobList = Sqlite::query($sql);
        return self::ListFormat($JobList);
    }

    /**
     * 按照分页显示数据
     * 默认第一页，每页20条数据
     */
    public static function getListInPage($page = 1, $pageSize = 20)
    {
        $p = $page < 1 ? 0 : (int)$page;
        $offset = ($page - 1) * $pageSize;
        $sql = "SELECT * FROM job_list ORDER BY id DESC  LIMIT  " . $offset . ',' . $pageSize;
        $sqlResult = Sqlite::query($sql);
        return self::ListFormat($sqlResult);
    }

    private static function ListFormat($sqlResult)
    {
        $data = array();
        if (!empty($sqlResult)) {
            foreach ($sqlResult as $job) {
                $tmp = array();
                $tmp['title'] = $job['job_title'];
                $tmp['desc'] = $job['job_desc'];
                $tmp['icon'] = 'mui-icon mui-icon-person-filled';
                $tmp['href'] = Url::toRoute(['/job/detail', 'id' => $job['id']]);
                $tmp['id'] = $job['id'];
                $data[] = $tmp;
            }
        }
        return $data;
    }

    public static function getCont()
    {
        $data = Sqlite::query("SELECT COUNT(1) as c FROM job_list");
        if (!empty($data)) {
            $c = current($data[0]);
            return $c;
        } else {
            return -1;
        }
    }


    public static function Del($id)
    {
        $sql = "DELETE FROM job_list where id= '" . (int)$id . "'";
        return Sqlite::execute($sql);
    }


}
