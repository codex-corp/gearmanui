<?php

namespace GearmanUI\Gearman\Task;

class Remover implements IRemover
{

    /**
     * @var string[]
     */
    protected $servers = array();

    /**
     * @param string[] $servers
     */
    public function __construct(array $servers)
    {
        $this->servers = $servers;
    }

    /**
     * Removes all tasks defined by name of a functions
     * Returns number of removed tasks
     * @param string $function
     * @return int
     */
    public function removeByFunctionName($function)
    {
        $servers = array_map(function(array $serverInfo){
            return $serverInfo['addr'];
        }, $this->servers);
        $serversString = implode(',', $servers);

        $worker = new \GearmanWorker();
        $worker->setTimeout(1000);
        $worker->addServers($serversString);
        $worker->addFunction($function, function(){});

        $numberOfRemovedJobs = 0;
        while($worker->work())
        {
            $numberOfRemovedJobs++;
        }

        return $numberOfRemovedJobs;
    }
}