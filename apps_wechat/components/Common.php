<?php
namespace apps_wechat\components;

use Yii;

/**
 * Site controller
 */
class Common
{

    /**
     * 求两个日期之间相差的天数
     * (针对1970年1月1日之后，求之前可以采用泰勒公式)
     * @param string $day1
     * @param string $day2
     * @return number
     */
    public static function diffBetweenTwoDays($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

    /**
     * 用uniqid获取一个基于当前的微秒数生成的唯一不重复的字符串（但是他的前7位貌似很久才会发生变动，所以不用考虑可删除），取其第8到13位。但是这个字符串里面有英文字母，咋办？
     *用ord获取他的ASCII码，所以就有了下一步：用str_split把这个字符串分割为数组，用array_map去操作（速度快点）。
     *然后返回的还是一个数组，KO，在用implode弄成字符串，但是字符长度不定，取前固定的几位，然后前面加上当前的年份和日期，这个方法生成的订单号，全世界不会有多少重复的。
     *当然，除非你把服务器时间往前调，但是调也不用怕，哥不相信他会在同一微秒内下两次订单，网络数据传输也要点时间的，即便你是在本地。
     * @return string
     */
    public static function generate_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}
