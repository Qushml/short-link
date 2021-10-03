<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        $text = 'http://google.com';

        var_dump(substr(md5(uniqid(mt_rand(), true)),0,8));
        var_dump(substr(md5(uniqid(mt_rand(), true)),0,8));
        var_dump(substr(md5(uniqid(mt_rand(), true)),0,8));
//        foreach (hash_algos() as $algo) {
//            echo "$algo) ". hash($algo, $text) . PHP_EOL;
//        }

    }
}
