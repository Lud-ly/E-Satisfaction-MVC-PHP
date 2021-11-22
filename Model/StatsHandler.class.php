<?php

class StatsHandler extends AbstractStats
{


    public function __construct()
    {
    }

    public function getStats($data)
    {
        $arrayOfStats = [];
        $arrayOfStats['countData'] = count($data);
        $arrayOfStats['averageNotation'] = "";
        $averageNotation = 0;
        $arrayOfUniqueIdAnswers = array_unique(array_column($data, 'idAnswerType'));
        foreach ($arrayOfUniqueIdAnswers as $answer) {
            $feedbackByIdAnswer = array_values(array_filter($data, function ($item) use ($answer) {
                return $item['idAnswerType'] == $answer;
            }));

            $feedbackStats['idAnswerType'] = $feedbackByIdAnswer[0]['idAnswerType'];
            $feedbackStats['answerValue'] = $feedbackByIdAnswer[0]['answerValue'];
            $feedbackStats['count'] = count($feedbackByIdAnswer);
            $feedbackStats['percent'] = floor($feedbackStats['count'] / count($data) * 100);

            $arrayOfStats['answers'][] = $feedbackStats;
            $averageNotation += $feedbackStats['count'] * $feedbackStats['answerValue'];
        }
        $averageNotation = $averageNotation / $arrayOfStats['countData'];
        $arrayOfStats['averageNotation'] = floatval(round($averageNotation, 2));

        return $arrayOfStats;
    }
}
