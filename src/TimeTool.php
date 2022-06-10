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

class TimeTool
{
    /**
     * @param string $type
     * @param bool $date
     * @param string $format
     * @return array
     * @describe:Get start and end time
     */
    public static function TimeBeginEnd($type = "today", $date = false, $format = "Y-m-d H:i:s") {
        switch (strtolower($type)) {
            case "tomorrow":
                $arr = [self::BeginTomorrow($date, $format), self::EndTomorrow($date, $format)];
                break;
            case "yesterday":
                $arr = [self::BeginYesterday($date, $format), self::EndYesterday($date, $format)];
                break;
            case "thisweek":
                $arr = [self::BeginThisWeek($date, $format), self::EndThisWeek($date, $format)];
                break;
            case "thisweekr":
                $arr = [self::BeginThisWeekR($date, $format), self::EndThisWeekR($date, $format)];
                break;
            case "lastweek":
                $arr = [self::BeginLastWeek($date, $format), self::EndLastWeek($date, $format)];
                break;
            case "thismonth":
                $arr = [self::BeginThisMonth($date, $format), self::EndThisMonth($date, $format)];
                break;
            case "lastmonth":
                $arr = [self::BeginLastMonth($date, $format), self::EndLastMonth($date, $format)];
                break;
            case "thisseason":
                $arr = [self::BeginThisSeason($date, $format), self::EndThisSeason($date, $format)];
                break;
            case "lastseason":
                $arr = [self::BeginLastSeason($date, $format), self::EndLastSeason($date, $format)];
                break;
            case "thisyear":
                $arr = [self::BeginThisYear($date, $format), self::EndThisYear($date, $format)];
                break;
            case "tomorrowyear":
                $arr = [self::BeginTomorrowYear($date, $format), self::EndTomorrowYear($date, $format)];
                break;
            case "lastyear":
                $arr = [self::BeginLastYear($date, $format), self::EndLastYear($date, $format)];
                break;
            default:
                $arr = [self::BeginToday($date, $format), self::EndToday($date, $format)];
                break;
        }
        return $arr;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:start time today
     */
    public static function BeginToday($date = true, $format = "Y-m-d H:i:s") {
        $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        return $date ? date($format, $today) : $today;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:end time today
     */
    public static function EndToday($date = true, $format = "Y-m-d H:i:s") {
        $today = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        return $date ? date($format, $today) : $today;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:start time tomorrow
     */
    public static function BeginTomorrow($date = true, $format = "Y-m-d H:i:s") {
        $Tomorrow = mktime(0, 0, 0, date('m'), date('d'), date('Y')) + 86400;
        return $date ? date($format, $Tomorrow) : $Tomorrow;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:end time tomorrow
     */
    public static function EndTomorrow($date = true, $format = "Y-m-d H:i:s") {
        $Tomorrow = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) + 86399;
        return $date ? date($format, $Tomorrow) : $Tomorrow;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start time yesterday
     */
    public static function BeginYesterday($date = true, $format = "Y-m-d H:i:s") {
        $Yesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        return $date ? date($format, $Yesterday) : $Yesterday;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:end time yesterday
     */
    public static function EndYesterday($date = true, $format = "Y-m-d H:i:s") {
        $Yesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
        return $date ? date($format, $Yesterday) : $Yesterday;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start time of the week [start time is Monday, end time is Sunday]
     */
    public static function BeginThisWeek($date = true, $format = "Y-m-d H:i:s") {
        $ThisWeek = strtotime("this week Monday", time());
        return $date ? date($format, $ThisWeek) : $ThisWeek;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:End time of the week [start time is Monday, end time is Sunday]
     */
    public static function EndThisWeek($date = true, $format = "Y-m-d H:i:s") {
        $ThisWeek = strtotime("this week Sunday", time()) + 86399;
        return $date ? date($format, $ThisWeek) : $ThisWeek;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start time of the week [start time is Sunday, end time is Saturday]
     */
    public static function BeginThisWeekR($date = true, $format = "Y-m-d H:i:s") {
        $ThisWeek = mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y"));
        return $date ? date($format, $ThisWeek) : $ThisWeek;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:End time of the week [start time is Sunday, end time is Saturday]
     */
    public static function EndThisWeekR($date = true, $format = "Y-m-d H:i:s") {
        $ThisWeek = mktime(0, 0, 0, date("m"), date("d") - date("w") + 7, date("Y"));
        return $date ? date($format, $ThisWeek) : $ThisWeek;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start time last week
     */
    public static function BeginLastWeek($date = true, $format = "Y-m-d H:i:s") {
        $LastWeek = strtotime("last week Monday", time());
        return $date ? date($format, $LastWeek) : $LastWeek;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:End of last week
     */
    public static function EndLastWeek($date = true, $format = "Y-m-d H:i:s") {
        $LastWeek = strtotime("last week Sunday", time()) + 86399;
        return $date ? date($format, $LastWeek) : $LastWeek;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start of the month
     */
    public static function BeginThisMonth($date = true, $format = "Y-m-d H:i:s") {
        $ThisMonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
        return $date ? date($format, $ThisMonth) : $ThisMonth;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:End of the month
     */
    public static function EndThisMonth($date = true, $format = "Y-m-d H:i:s") {
        $ThisMonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));
        return $date ? date($format, $ThisMonth) : $ThisMonth;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start of last month
     */
    public static function BeginLastMonth($date = true, $format = "Y-m-d H:i:s") {
        $LastMonth = mktime(0, 0, 0, date("m") - 1, 1, date("Y"));
        return $date ? date($format, $LastMonth) : $LastMonth;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:End of last month
     */
    public static function EndLastMonth($date = true, $format = "Y-m-d H:i:s") {
        $LastMonth = mktime(23, 59, 59, date("m"), 0, date("Y"));
        return $date ? date($format, $LastMonth) : $LastMonth;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:start of the quarter
     */
    public static function BeginThisSeason($date = true, $format = "Y-m-d H:i:s") {
        $season = ceil((date('n')) / 3);
        $ThisSeason = mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y'));
        return $date ? date($format, $ThisSeason) : $ThisSeason;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:end of the quarter
     */
    public static function EndThisSeason($date = true, $format = "Y-m-d H:i:s") {
        $season = ceil((date('n')) / 3);
        $ThisSeason = mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y'));
        return $date ? date($format, $ThisSeason) : $ThisSeason;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start of last quarter
     */
    public static function BeginLastSeason($date = true, $format = "Y-m-d H:i:s") {
        $season = ceil((date('n')) / 3) - 1;
        $ThisSeason = mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y'));
        return $date ? date($format, $ThisSeason) : $ThisSeason;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:end of last quarter
     */
    public static function EndLastSeason($date = true, $format = "Y-m-d H:i:s") {
        $season = ceil((date('n')) / 3) - 1;
        $ThisSeason = mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y'));
        return $date ? date($format, $ThisSeason) : $ThisSeason;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Start of the year
     */
    public static function BeginThisYear($date = true, $format = "Y-m-d H:i:s") {
        $ThisYear = mktime(0, 0, 0, 1, 1, date('Y'));
        return $date ? date($format, $ThisYear) : $ThisYear;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:End of the year
     */
    public static function EndThisYear($date = true, $format = "Y-m-d H:i:s") {
        $ThisYear = mktime(23, 59, 59, 12, 31, date('Y'));
        return $date ? date($format, $ThisYear) : $ThisYear;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:next year start time
     */
    public static function BeginTomorrowYear($date = true, $format = "Y-m-d H:i:s") {
        $TomorrowYear = mktime(0, 0, 0, 1, 1, date('Y') + 1);
        return $date ? date($format, $TomorrowYear) : $TomorrowYear;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:end of next year
     */
    public static function EndTomorrowYear($date = true, $format = "Y-m-d H:i:s") {
        $TomorrowYear = mktime(23, 59, 59, 12, 31, date('Y') + 1);
        return $date ? date($format, $TomorrowYear) : $TomorrowYear;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:Started last year
     */
    public static function BeginLastYear($date = true, $format = "Y-m-d H:i:s") {
        $LastYear = mktime(0, 0, 0, 1, 1, date('Y') - 1);
        return $date ? date($format, $LastYear) : $LastYear;
    }


    /**
     * @param bool $date
     * @param string $format
     * @return false|int|string
     * @describe:end of last year
     */
    public static function EndLastYear($date = true, $format = "Y-m-d H:i:s") {
        $LastYear = mktime(23, 59, 59, 12, 31, date('Y') - 1);
        return $date ? date($format, $LastYear) : $LastYear;
    }


}