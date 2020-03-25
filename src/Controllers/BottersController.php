<?php

namespace BruteforceMovable\Controllers;

use BruteforceMovable\BaseController;
use BruteforceMovable\DatabaseManager;

class BottersController extends BaseController {
	protected $viewFolder = ''; 

	public function indexAction() {
        $dbCon = DatabaseManager::getHandle();
        
        $currentClaimCount = $this->getClaimCount();
        if ($currentClaimCount >= 15) {  
            return "nothing";
        }

        $this->updateDumperStatus();
        
        $statement = $dbCon->prepare('select ip_addr from minerstatus where TIMESTAMPDIFF(MINUTE, last_action_at, now()) < 5 order by last_action_at desc');
        $results = $statement->execute();

        if (count($results) < 1) {
            return "nothing";
        }
        
        $friendCodes = [];
        foreach ($results as $currentResult) {
            array_push($friendCodes, $currentResult['ip_addr']);
        }
        return count($friendCodes)."\n".implode("\n", $friendCodes);
	}
}
