<?php

namespace BruteforceMovable\Controllers;

use BruteforceMovable\BaseController;
use BruteforceMovable\DatabaseManager;

class GetFriendsController extends BaseController {
	protected $viewFolder = ''; 

	public function indexAction() {
        $dbCon = DatabaseManager::getHandle();
        $timeStarted = microtime(true);	
        $currentClaimCount = $this->getClaimCount();
        if ($currentClaimCount >= 15) {  
            return "nothing";
        }

        $this->updateDumperStatus();
        
        $statement = $dbCon->prepare('select * from seedqueue where state < 3 and claimedby is null and part1b64 is null order by id_seedqueue asc limit 5');
        $results = $statement->execute();

        if (count($results) < 1) {
            return "nothing";
        }
        
        $friendCodes = [];
        foreach ($results as $currentResult) {
            array_push($friendCodes, $currentResult['friendcode']);
        }
        return implode("\n", $friendCodes);
	}
}
