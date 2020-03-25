<?php

namespace BruteforceMovable;


abstract class BaseController {
    /** @var Router */
    protected $router;
    protected $viewFolder = '.';
    protected $request;

    /**
     * BaseController constructor.
     * @param $router Router
     */
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function process($actionName, $request) {
        $this->request = $request;
        $actionMethodName = $actionName . "Action";
        return $this->$actionMethodName();
    }

    protected function getClaimCount() {
		$dbCon = DatabaseManager::getHandle();
		$statement = $dbCon->prepare('select count(1) as action from seedqueue where claimedby like ? and TIMESTAMPDIFF(MINUTE, time_started, now()) < 10');
		$results = $statement->execute([$this->request->get['me']]);
		if (!isset($results[0])) return 0;
		$action = $results[0]['action'];
		return intval($action);
    }

    protected function updateDumperStatus() {
        $action = 0;
		$dbCon = DatabaseManager::getHandle();
		$sql = 'INSERT INTO minerstatus (ip_addr, last_action_at, last_action_change, action) VALUES (?, now(), ?, ?) ON DUPLICATE KEY UPDATE last_action_at = now(), action = ?, last_action_change = ?';
		$statement = $dbCon->prepare($sql);
		$actionChangeDate = date('Y-m-d H:i:s');
		$statement->execute([$this->request->get['me'], $actionChangeDate, $action, $action, $actionChangeDate]);
	}
}