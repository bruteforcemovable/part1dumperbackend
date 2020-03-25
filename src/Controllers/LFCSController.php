<?php

namespace BruteforceMovable\Controllers;

use BruteforceMovable\BaseController;
use BruteforceMovable\DatabaseManager;

class LFCSController extends BaseController {
	protected $viewFolder = '';

	public function indexAction() {
        if (isset($this->request->get['fc']) && isset($this->request->get['lfcs'])) {
            $dbCon = DatabaseManager::getHandle();

            $statement = $dbCon->prepare('update seedqueue set part1b64 = ? where friendcode like ? and claimedby is not null');
            $statement->execute([$this->request->get['lfcs'], $this->request->get['fc']]);  
            if ($statement->affected_rows == 1) {
                return "success";
            }
        }
        return "error";
	}
}
