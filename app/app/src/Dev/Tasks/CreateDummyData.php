<?php

namespace SilverStripe\Assets\Dev\Tasks;

use Portable\NewsApp\GuardianDummy;
use SilverStripe\Dev\BuildTask;

class CreateDummyData extends BuildTask
{
    private static $segment = 'create-dummy-data';
    protected $title = 'Create dummy data';
    protected $description = 'Creates dummy data from The Guardian Open Platform example data (https://open-platform.theguardian.com/explore/)';

    /**
     * @param HTTPRequest $request
     */
    public function run($request)
    {
        $existingData = GuardianDummy::get();
        foreach ($existingData as $data) {
            $data->delete();
            echo('deleted.'. PHP_EOL);
        }

        $dummyData = $this->DummyData();
        $dummyDataArray = json_decode($dummyData, true);
        $results = $dummyDataArray['response']['results'];

        //write to object
        foreach ($results as $result) {
            $object = GuardianDummy::create();
            $object->Title = $result['webTitle'];
            $object->URL = $result['webUrl'];
            $object->Date = $result['webPublicationDate'];
            $object->Section = $result['sectionName'];
            $object->write();
            echo('written '. $result['id'] . PHP_EOL);
        }

        echo('done!'. PHP_EOL);
    }

    public function DummyData()
    {
        //https://content.guardianapis.com/search?q=deadlifting&api-key=test
        
        $exampleJson = '{"response":{"status":"ok","userTier":"developer","total":15,"startIndex":1,"pageSize":10,"currentPage":1,"pages":2,"orderBy":"relevance","results":[{"id":"music/2021/nov/15/weight-loss-deadlifts-and-divorce-what-we-learned-from-adeles-tv-special","type":"article","sectionId":"music","sectionName":"Music","webPublicationDate":"2021-11-15T05:45:14Z","webTitle":"Weight loss, deadlifts and divorce: what we learned from Adele’s One Night Only special","webUrl":"https://www.theguardian.com/music/2021/nov/15/weight-loss-deadlifts-and-divorce-what-we-learned-from-adeles-tv-special","apiUrl":"https://content.guardianapis.com/music/2021/nov/15/weight-loss-deadlifts-and-divorce-what-we-learned-from-adeles-tv-special","isHosted":false,"pillarId":"pillar/arts","pillarName":"Arts"},{"id":"sport/2021/sep/06/luke-beveridges-bulldogs-have-the-smell-of-afl-history-about-them","type":"article","sectionId":"sport","sectionName":"Sport","webPublicationDate":"2021-09-05T17:30:32Z","webTitle":"Luke Beveridge’s Bulldogs have the smell of AFL history about them | Jonathan Horn","webUrl":"https://www.theguardian.com/sport/2021/sep/06/luke-beveridges-bulldogs-have-the-smell-of-afl-history-about-them","apiUrl":"https://content.guardianapis.com/sport/2021/sep/06/luke-beveridges-bulldogs-have-the-smell-of-afl-history-about-them","isHosted":false,"pillarId":"pillar/sport","pillarName":"Sport"},{"id":"lifeandstyle/2019/aug/31/fitness-tips-two-powerlifts-for-beginners","type":"article","sectionId":"lifeandstyle","sectionName":"Life and style","webPublicationDate":"2019-08-31T06:00:51Z","webTitle":"Fitness tips: the back squat and the deadlift for beginners","webUrl":"https://www.theguardian.com/lifeandstyle/2019/aug/31/fitness-tips-two-powerlifts-for-beginners","apiUrl":"https://content.guardianapis.com/lifeandstyle/2019/aug/31/fitness-tips-two-powerlifts-for-beginners","isHosted":false,"pillarId":"pillar/lifestyle","pillarName":"Lifestyle"},{"id":"lifeandstyle/2020/jan/02/how-to-set-fitness-goals-you-will-actually-keep","type":"article","sectionId":"lifeandstyle","sectionName":"Life and style","webPublicationDate":"2020-01-02T13:00:33Z","webTitle":"The six-pack can wait: how to set fitness goals you will actually keep","webUrl":"https://www.theguardian.com/lifeandstyle/2020/jan/02/how-to-set-fitness-goals-you-will-actually-keep","apiUrl":"https://content.guardianapis.com/lifeandstyle/2020/jan/02/how-to-set-fitness-goals-you-will-actually-keep","isHosted":false,"pillarId":"pillar/lifestyle","pillarName":"Lifestyle"},{"id":"commentisfree/2020/may/09/the-right-cannot-resist-a-culture-war-against-the-liberal-elite-even-now","type":"article","sectionId":"commentisfree","sectionName":"Opinion","webPublicationDate":"2020-05-09T17:30:02Z","webTitle":"The right cannot resist a culture war against the \'liberal elite\', even now | Nick Cohen","webUrl":"https://www.theguardian.com/commentisfree/2020/may/09/the-right-cannot-resist-a-culture-war-against-the-liberal-elite-even-now","apiUrl":"https://content.guardianapis.com/commentisfree/2020/may/09/the-right-cannot-resist-a-culture-war-against-the-liberal-elite-even-now","isHosted":false,"pillarId":"pillar/opinion","pillarName":"Opinion"},{"id":"lifeandstyle/2019/jan/01/how-to-get-better-at-running-sprinting-fartlek-and-romanian-deadlifts","type":"article","sectionId":"lifeandstyle","sectionName":"Life and style","webPublicationDate":"2019-01-01T14:00:02Z","webTitle":"Sprinting, fartlek and Romanian deadlifts – how to get better at running","webUrl":"https://www.theguardian.com/lifeandstyle/2019/jan/01/how-to-get-better-at-running-sprinting-fartlek-and-romanian-deadlifts","apiUrl":"https://content.guardianapis.com/lifeandstyle/2019/jan/01/how-to-get-better-at-running-sprinting-fartlek-and-romanian-deadlifts","isHosted":false,"pillarId":"pillar/lifestyle","pillarName":"Lifestyle"},{"id":"lifeandstyle/2018/nov/19/butt-seriously-how-bottoms-became-a-fitness-obsession","type":"article","sectionId":"lifeandstyle","sectionName":"Life and style","webPublicationDate":"2018-11-19T12:00:28Z","webTitle":"Butt seriously: how bottoms became a fitness obsession","webUrl":"https://www.theguardian.com/lifeandstyle/2018/nov/19/butt-seriously-how-bottoms-became-a-fitness-obsession","apiUrl":"https://content.guardianapis.com/lifeandstyle/2018/nov/19/butt-seriously-how-bottoms-became-a-fitness-obsession","isHosted":false,"pillarId":"pillar/lifestyle","pillarName":"Lifestyle"},{"id":"lifeandstyle/2018/jun/27/get-shredded-in-six-weeks-the-problem-with-extreme-male-body-transformations","type":"article","sectionId":"lifeandstyle","sectionName":"Life and style","webPublicationDate":"2018-06-27T05:00:30Z","webTitle":"‘Get shredded in six weeks!’ The problem with extreme male body transformations","webUrl":"https://www.theguardian.com/lifeandstyle/2018/jun/27/get-shredded-in-six-weeks-the-problem-with-extreme-male-body-transformations","apiUrl":"https://content.guardianapis.com/lifeandstyle/2018/jun/27/get-shredded-in-six-weeks-the-problem-with-extreme-male-body-transformations","isHosted":false,"pillarId":"pillar/lifestyle","pillarName":"Lifestyle"},{"id":"business/2016/nov/03/ahilan-kathirgamathamby-obituary","type":"article","sectionId":"business","sectionName":"Business","webPublicationDate":"2016-11-03T16:29:54Z","webTitle":"Ahilan Kathirgamathamby obituary","webUrl":"https://www.theguardian.com/business/2016/nov/03/ahilan-kathirgamathamby-obituary","apiUrl":"https://content.guardianapis.com/business/2016/nov/03/ahilan-kathirgamathamby-obituary","isHosted":false,"pillarId":"pillar/news","pillarName":"News"},{"id":"commentisfree/2016/oct/28/facing-my-fear-gym-membership-humiliation-health-workouts","type":"article","sectionId":"commentisfree","sectionName":"Opinion","webPublicationDate":"2016-10-28T15:15:55Z","webTitle":"Facing my fear: I was scared of being laughed out of the gym | David Ferguson","webUrl":"https://www.theguardian.com/commentisfree/2016/oct/28/facing-my-fear-gym-membership-humiliation-health-workouts","apiUrl":"https://content.guardianapis.com/commentisfree/2016/oct/28/facing-my-fear-gym-membership-humiliation-health-workouts","isHosted":false,"pillarId":"pillar/opinion","pillarName":"Opinion"}]}}';
        return $exampleJson;
    }
}
