<?php

namespace Fredde\Start;

/**
 * A database driven model using the Active Record design pattern.
 */
class Start
{
    public function getNew($queobj)
    {
        $questions = $queobj->findAll();
        $qArr = [];

        foreach (array_reverse($questions) as $question) {
            if ($question->id > count($questions) - 3) {
                array_push($qArr, $question->title);
            }
        }

        return $qArr;
    }

    public function getActive($useobj)
    {
        $users = $useobj->findAll();
        $uArr = [];

        foreach ($users as $user) {
            $uArr[$user->acronym] = $user->activityscore;
        }

        arsort($uArr);
        $uArr = array_slice($uArr, 0, 3);

        return $uArr;
    }

    public function getUsed($tagobj, $queobj)
    {
        $tags = $tagobj->findAll();
        $questions = $queobj->findAll();
        $tArr = [];

        foreach ($tags as $tag) {
            $count = 0;

            foreach ($questions as $question) {
                if ($tag->word == $question->tag1 || $tag->word == $question->tag2 || $tag->word == $question->tag3) {
                    $count += 1;
                }
            }

            if ($count != 0) {
                $tArr[$tag->word] = $count;
            }
        }

        arsort($tArr);
        $tArr = array_slice($tArr, 0, 3);

        return $tArr;
    }
}
