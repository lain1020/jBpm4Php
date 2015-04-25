<?php
/**
 * Copyright 2015 Fernando Libório
 * 
 * This file is part of jBpm4Php.
 *
 * jBpm4Php is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * jBpm4Php is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with jBpm4Php.  If not, see <http://www.gnu.org/licenses/>. 
 */

namespace jBpm4Php\REST\Remote\Task;

use \jBpm4Php\Services\Abstract_Rest_Command;

/**
 * Runtime Task Calls
 *  
 * @package jBpm4Php\REST\Remote\Task
 * @author  Fernando Libório 
 * @license LGPL, version 3
 */
class Task_Service extends Abstract_Rest_Command
{
	/**
     * Activates a task.
     * 
     * @access public
     * @param  string $task_id 
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function activate($task_id)
    {
    	$url = sprintf("%s/task/%s/activate", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Claims a task.
     * 
     * @access public
     * @param  string $task_id 
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function claim($task_id)
    {
    	$url = sprintf("%s/task/%s/claim", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Claims the next available task.
     * 
     * @access public
     * @param  string $task_id
     * @param  string $lang 
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function claim_next_available($task_id, $lang = 'en-UK')
    {
    	$url = sprintf("%s/task/%s/claimnextavailable", 
    		$this->engine->url,
    		$task_id
    	);

    	$map = (is_null($lang)) ? NULL : array('language'=>$lang);

        return json_decode($this->execute($url, TRUE, $map));
    }

    /**
     * Completes a task.
     * 
     * @access public
     * @param  string $task_id
     * @param  array $map You can only pass basic types. 
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function complete($task_id, $map = NULL)
    {
    	$url = sprintf("%s/task/%s/complete", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE, $map));
    }

	/**
     * Delegates a task.
     * 
     * @access public
     * @param  string $task_id
     * @param  string $target_id Identifies the user or group to which the task is delegated 
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function delegate($task_id, $target_id)
    {
    	$url = sprintf("%s/task/%s/delegate", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE, array('targetId'=>$target_id)));
    }    

    /**
     * Exits a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function exit_task($task_id)
    {
    	$url = sprintf("%s/task/%s/exit", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Fails a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function fail($task_id)
    {
    	$url = sprintf("%s/task/%s/fail", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Delegates a task.
     * 
     * @access public
     * @param  string $task_id
     * @param  string $target_id Identifies the user or group to which the task is forwarded 
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function forward($task_id, $target_id)
    {
    	$url = sprintf("%s/task/%s/forward", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE, array('targetId'=>$target_id)));
    }

    /**
     * Nominates a task.
     * 
     * @access public
     * @param  string $task_id
     * @param  string $target_id Identifies the user(s) or group(s) that are nominated for the task
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function nominate($task_id, $target_id)
    {
    	$url = sprintf("%s/task/%s/nominate", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE, array('targetId'=>$target_id)));
    }

    /**
     * Releases a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function release($task_id)
    {
    	$url = sprintf("%s/task/%s/release", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Resumes a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function resume($task_id)
    {
    	$url = sprintf("%s/task/%s/resume", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Skips a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function skip($task_id)
    {
    	$url = sprintf("%s/task/%s/skip", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Starts a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function start($task_id)
    {
    	$url = sprintf("%s/task/%s/start", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Stops a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function stop($task_id)
    {
    	$url = sprintf("%s/task/%s/stop", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Suspends a task.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbGenericResponse 
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbGenericResponse
     */
    public function suspend($task_id)
    {
    	$url = sprintf("%s/task/%s/suspend", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Checks that the task idetified by taskId exists and generates an URL to show the task form on a remote 
     * application.
     * 
     * @access public
     * @param  string $task_id
     * @return A JaxbTaskFormResponse instance, that contains the URL to the task form
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbTaskFormResponse
     */
    public function show_task_form($task_id)
    {
    	$url = sprintf("%s/task/%s/showTaskForm", 
    		$this->engine->url,
    		$task_id
    	);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * The returned tasks should have the potential owner identified by the parameter given.
     * 
     * @access public
     * @param  string $owner
     * @param  string $lang
     * @return A list of TaskSummaryImpl instances
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote TaskSummaryImpl
     */  
    public function get_tasks($owner, $lang = 'en-UK')
    {
        $map = array('potentialOwner'=>$owner, 'language', $lang);
        $response = $this->query($map);

        if (! is_object($response) ) {
            return $response->taskSummaryList; 
        }

        return array();
    }

    /**
     * Queries the available non-archived tasks.
     * 
     * @access public
     * @param  array $map
     * @return A JaxbTaskSummaryListResponse with a list of TaskSummaryImpl instances
     * @link   https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote JaxbTaskSummaryListResponse
     */
    public function query($map)
    {
    	$url = sprintf("%s/task/query", $this->engine->url);

        return json_decode($this->execute($url, FALSE, $map));
    }
}