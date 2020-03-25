<?php

namespace BruteforceMovable\Controllers;

use BruteforceMovable\BaseController;
use BruteforceMovable\DatabaseManager;

class ClaimFriendsController extends BaseController {
	protected $viewFolder = '';

	public function indexAction() {
        if (isset($this->request->get['fc'])) {
            $dbCon = DatabaseManager::getHandle();

            $statement = $dbCon->prepare('update seedqueue set state = state + 1, time_started = now(), claimedby = ? where friendcode like ? and state < 3 and claimedby is null');
            $statement->execute([$this->request->get['me'], $this->request->get['fc']]);  
            if ($statement->affected_rows == 1) {
                return "success";
            }
        }
        return "error";
    }
    
    public function unclaimAction() {
        if (isset($this->request->get['fc'])) {
            $dbCon = DatabaseManager::getHandle();

            $statement = $dbCon->prepare('update seedqueue set state = state - 1, time_started = now(), claimedby = null where claimedby like ? and friendcode like ?');
            $statement->execute([$this->request->get['me'], $this->request->get['fc']]);  
            if ($statement->affected_rows == 1) {
                return "success";
            }
        }
        return "error";
    }
}
