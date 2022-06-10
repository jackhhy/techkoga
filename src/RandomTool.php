<?php
/**
 *                    _ooOoo_
 *                   o8888888o
 *                   88" . "88
 *                   (| -_- |)
 *                    O\ = /O
 *                ____/`---'\____
 *              .   ' \\| |// `.
 *               / \\||| : |||// \
 *             / _||||| -:- |||||- \
 *               | | \\\ - /// | |
 *             | \_| ''\---/'' | |
 *              \ .-\__ `-` ___/-. /
 *           ___`. .' /--.--\ `. . __
 *        ."" '< `.___\_<|>_/___.' >'"".
 *       | | : `- \`.;`\ _ /`;.`/ - ` : | |
 *         \ \ `-. \_ __\ /__ _/ .-` / /
 * ======`-.____`-.___\_____/___.-`____.-'======
 *                    `=---='
 *
 * .............................................
 *          佛祖保佑             永无BUG
 */

namespace techkoga\Tools;


class RandomTool
{

    /**
     * Generate numbers and letters
     *
     * @param int $len 长度
     *
     * @return string
     */
    public static function alnum($len = 6)
    {
        return self::build('alnum', $len);
    }


    /**
     * Generate characters only
     *
     * @param int $len
     *
     * @return string
     */
    public static function alpha($len = 6)
    {
        return self::build('alpha', $len);
    }

    /**
     * Generate random numbers of specified length
     *
     * @param int $len 长
     *
     * @return string
     */
    public static function numeric($len = 4)
    {
        return self::build('numeric', $len);
    }

    /**
     * A random string of numbers and letters
     *
     * @param int $len
     *
     * @return string
     */
    public static function nozero($len = 4)
    {
        return self::build('nozero', $len);
    }

    /**
     * usable random number generation
     *
     * @param string $type type alpha/alnum/numeric/nozero/unique/md5/encrypt/sha1
     * @param int    $len
     *
     * @return string
     */
    public static function build($type = 'alnum', $len = 8)
    {
        switch ($type) {
            case 'alpha':
            case 'alnum':
            case 'numeric':
            case 'nozero':
                switch ($type) {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }

                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique':
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt':
            case 'sha1':
                return sha1(uniqid(mt_rand(), true));
        }
    }

    /**
     * Get the key name based on the probability of an array element
     *
     * @param array $ps     array('p1'=>20, 'p2'=>30, 'p3'=>50);
     * @param int   $num    The default is 1, which is the random number
     * @param bool  $unique The default is true, that is, when num>1, is the random number unique?
     *
     * @return mixed  Returns the key name when num is 1, otherwise returns a one-dimensional array
     */
    public static function lottery($ps, $num = 1, $unique = true)
    {
        if (! $ps) {
            return $num == 1 ? '' : [];
        }
        if ($num >= count($ps) && $unique) {
            $res = array_keys($ps);

            return $num == 1 ? $res[0] : $res;
        }
        $max_exp = 0;
        $res = [];
        foreach ($ps as $key => $value) {
            $value = substr($value, 0, stripos($value, '.') + 6);
            $exp = strlen(strstr($value, '.')) - 1;
            if ($exp > $max_exp) {
                $max_exp = $exp;
            }
        }
        $pow_exp = pow(10, $max_exp);
        if ($pow_exp > 1) {
            reset($ps);
            foreach ($ps as $key => $value) {
                $ps[$key] = $value * $pow_exp;
            }
        }
        $pro_sum = array_sum($ps);
        if ($pro_sum < 1) {
            return $num == 1 ? '' : [];
        }
        for ($i = 0; $i < $num; $i++) {
            $rand_num = mt_rand(1, $pro_sum);
            reset($ps);
            foreach ($ps as $key => $value) {
                if ($rand_num <= $value) {
                    break;
                } else {
                    $rand_num -= $value;
                }
            }
            if ($num == 1) {
                $res = $key;
                break;
            } else {
                $res[$i] = $key;
            }
            if ($unique) {
                $pro_sum -= $value;
                unset($ps[$key]);
            }
        }

        return $res;
    }

    /**
     * Get Global Unique ID
     *
     * @return string
     */
    public static function uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}