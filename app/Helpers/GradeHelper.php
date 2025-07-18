<?php

namespace App\Helpers;

class GradeHelper
{
    /**
     * 学年名に応じたCSSクラスを返す
     *
     * @param string $gradeName
     * @return string
     */
    public static function gradeColorClass($gradeName)
    {
        // 小学校の場合
        if (strpos($gradeName, '小学校') !== false) {
            return 'elementary';
        }
        
        // 中学校の場合
        if (strpos($gradeName, '中学校') !== false) {
            return 'middle';
        }
        
        // 高校の場合
        if (strpos($gradeName, '高校') !== false) {
            return 'high';
        }
        
        // デフォルト
        return 'elementary';
    }
    
    /**
     * 学年の順序を返す（ソート用）
     *
     * @param string $gradeName
     * @return int
     */
    public static function getGradeOrder($gradeName)
    {
        $gradeOrder = [
            '小学校1年生' => 1,
            '小学校2年生' => 2,
            '小学校3年生' => 3,
            '小学校4年生' => 4,
            '小学校5年生' => 5,
            '小学校6年生' => 6,
            '中学校1年生' => 7,
            '中学校2年生' => 8,
            '中学校3年生' => 9,
            '高校1年生' => 10,
            '高校2年生' => 11,
            '高校3年生' => 12,
        ];
        
        return $gradeOrder[$gradeName] ?? 999;
    }
}