<?php

namespace GearmanUI\Gearman\Task;

interface IRemover
{

    /**
     * Removes all tasks defined by name of a functions
     * Returns number of removed tasks
     * @param string $function
     * @return int
     */
    public function removeByFunctionName($function);

}