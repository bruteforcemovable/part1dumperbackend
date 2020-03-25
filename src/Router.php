<?php

namespace BruteforceMovable;

class Router {
    private function getController($request) {

		$pageArray = explode('/', $request->server['request_uri']);

		switch ($pageArray[1]) {
			case 'getfcs.php':
				return ['GetFriends', 'index'];
			case 'claimfc.php':
				return ['ClaimFriends', 'index'];
			case 'getList.php':
				return ['ClaimedFriends', 'index'];
			case 'timeout.php':
				return ['ClaimedFriends', 'timeout'];
			case 'setlfcs.php':
				return ['LFCS', 'index'];
			case 'botters.php':
				return ['Botters', 'index'];
			case 'trustedreset.php':
				return ['ClaimFriends', 'unclaim'];
			case 'getStatus.php':
				return ['GetStatus', 'index'];
			case 'resettimeout.php':
				return ['GetStatus', 'resettimeout'];
			default:
				return ['GetFriends', 'index'];
				break;
		}
    }

    /**
     * @param $dbManager DatabaseManager
     */
    public function process($request) {
        $controllerAction = $this->getController($request);
        $controllerClassName = "\\BruteforceMovable\\Controllers\\" . $controllerAction[0] . "Controller";
        $controllerInstance = new $controllerClassName($this);

        return $controllerInstance->process($controllerAction[1], $request);
    }
}
