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

namespace jBpm4Php\Services;

use \jBpm4Php\REST\Remote\Task\Task_Service;
use \jBpm4Php\REST\Remote\Runtime\Runtime_Service;
use \jBpm4Php\REST\Remote\History\History_Service;
use \jBpm4Php\REST\Remote\Deployment\Deployment_Service;

/**
 * Runtime Engine Class
 *  
 * @package jBpm4Php\Services
 * @author  Fernando Libório 
 * @license LGPL, version 3
 */
class Runtime_Engine
{
	private $url;
	private $deployment_id;
	private $authentication_type;
	private $username;
	private $password;

	/**
	 * Constructor
     * 
     * @access public 
	 * @param  string $url This is the URL of the deployed jbpm-console, kie-wb or BPMS instance. For example: http://localhost:8080/jbpm-console/
	 * @param  string $deployment_id This is the name (id) of the deployment the RuntimeEngine should interact with.
	 * @param  string $authentication_type Basic or Form Based
	 * @param  string $username This is the user name needed to access the REST API.
	 * @param  string $password This is the password needed to access the REST API.
	 */
    public function __construct($url, $deployment_id, $authentication_type, $username, $password) 
    {
        if (!preg_match("/[\w\.-]+(:[\w\.-]+){2,2}(:[\w\.-]*){0,2}/", $deployment_id)) {
            throw new Exception("Invalid deploymentId value");
        }

        $this->url = sprintf("%s/rest", $url);
        $this->deployment_id = $deployment_id;
        $this->authentication_type = $authentication_type;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Getter
     * 
     * @access public
     * @param  mixed $name 
     * @return mixed
     */
    public function __get($name) 
    {
        return $this->$name;
    }

    /**
     * Returns a new instance of Runtime_Service class.
     * 
     * @access public
     * @see    Runtime_Service
     * @return Runtime_Service
     */
    public function get_runtime_service()
    {
        return new Runtime_Service($this);
    }

    /**
     * Returns a new instance of History_Service class.
     * 
     * @access public
     * @see    History_Service
     * @return History_Service
     */
    public function get_history_service()
    {
        return new History_Service($this);
    }

    /**
     * Returns a new instance of Task_Service class.
     * 
     * @access public 
     * @see    Task_Service
     * @return Task_Service
     */
    public function get_task_service()
    {
        return new Task_Service($this);
    }

    /**
     * Returns a new instance of Deployment_Service class.
     * 
     * @access public
     * @see    Deployment_Service
     * @return Deployment_Service
     */
    public function get_deployment_service()
    {
        return new Deployment_Service($this);
    }
}

/**
 * Authentication Type Enumerator
 *  
 * @package jBpm4Php\Services
 * @author  Fernando Libório 
 * @license LGPL, version 3
 */
abstract class Authentication_Type
{
    const BASIC      = 'BASIC';
    const FORM_BASED = 'FORM_BASED';
}