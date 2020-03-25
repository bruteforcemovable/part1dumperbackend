<?php

namespace BruteforceMovable\Controllers;

use BruteforceMovable\BaseController;
use BruteforceMovable\DatabaseManager;

class ClaimedFriendsController extends BaseController {
	protected $viewFolder = ''; 

	public function indexAction() {
        $dbCon = DatabaseManager::getHandle();
        $timeStarted = microtime(true);	

        $statement = $dbCon->prepare('select * from seedqueue where part1b64 is null and claimedby = ? and TIMESTAMPDIFF(MINUTE, time_started, now()) < 10 order by id_seedqueue asc');
        $results = $statement->execute([$this->request->get['me']]);

        if (count($results) < 1) {
            return "nothing";
        }
        
        $friendCodes = [];
        foreach ($results as $currentResult) {
            array_push($friendCodes, $currentResult['friendcode']);
        }
        return implode("\n", $friendCodes);
    }
    
    public function timeoutAction() {
        return "success";
    }
}
