<?php namespace Screeenly\Screenshot;

use Screeenly\Screenshot\Screenshot;

/**
 * Interface description.
 *
 * @author  Stefan Zweifel
 */
interface ClientInterface
{

    /**
     * Method description.
     *
     * @author  Stefan Zweifel
     * @param   type   $parameter
     * @return type
     */
    public function build();

    public function capture(Screenshot $screenshot);

}