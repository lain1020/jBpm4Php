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

namespace jBpm4Php\REST\Remote\Deployment;

use \jBpm4Php\Services\Abstract_Rest_Command;

/**
 * Runtime Deployment Calls
 *  
 * @package jBpm4Php\REST\Remote\Deployment
 * @author  Fernando Libório 
 * @license LGPL, version 3
 * @link    http://docs.jboss.com/jbpm/v6.2/userguide/jBPMRemoteAPI.html jBPM REST Call documentation
 * @link    https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote All objects returned are described on the Kie Remote API (Java)
 */
class Deployment_Service extends Abstract_Rest_Command
{
    /**
     * Returns a list of all the available deployed instances in a JaxbDeploymentUnitList instance.
     * 
     * @access public
     * @return object A JaxbDeploymentUnitList 
     */
    public function get_deployed_units()
    {
    	$url = sprintf("%s/deployment", $this->engine->url);

        return json_decode($this->execute($url, FALSE));
    }

    /**
     * Returns a JaxbDeploymentUnit instance containing th e information (including the configuration) of the deployment unit.
     * 
     * @access public
     * @param  string $deployment_id
     * @return object A JaxbDeploymentUnit
     */
    public function get_deployment($deployment_id)
    {
        $url = sprintf("%s/deployment/%s", $this->engine->url, $deployment_id);

        return json_decode($this->execute($url, FALSE));
    }

    /**
     * Deploys the deployment unit referenced by the deploymentId.
     * 
     * @access public
     * @param  string $deployment_id
     * @param  array  $map Deployment descriptor as a key-value pair: array('audit-mode'=>'JMS', 'runtime-strategy'=>'PER_PROCESS_INSTANCE'); 
     * @return object A JaxbDeploymentJobResult
     */
    public function deploy($deployment_id, $map = NULL)
    {
        $url = sprintf("%s/deployment/%s/deploy", $this->engine->url, $deployment_id);

        $xml_body = '<deployment-descriptor xsi:schemaLocation="http://www.jboss.org/jbpm deployment-descriptor.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
        foreach ($map as $key => $value) {
            $xml_body.= sprintf("<%s>%s</%s>", $key, $value, $key);
        }
        $xml_body.= '</deployment-descriptor>';

        return json_decode($this->execute($url, TRUE, array('mergemode'=>'OVERRIDE_ALL'), $xml_body));
    }

    /**
     * Undeploys the deployment unit referenced by the deploymentId.
     * 
     * @access public
     * @param  string $deployment_id
     * @return object A JaxbDeploymentJobResult 
     */
    public function undeploy($deployment_id)
    {
        $url = sprintf("%s/deployment/%s/undeploy", $this->engine->url, $deployment_id);

        return json_decode($this->execute($url, TRUE));
    }
}