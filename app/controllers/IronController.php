<?php

class IronController
{
    /**
     * Delete a given screenshot from our system
     * Fired 7 days after screenshot creation
     *
     * @param  object $job
     * @param  array $data
     * @return void
     */
    public function deleteScreenshot($job, $data)
    {

        $id   = $data['id'];
        $log  = APILog::find($id);
        $path = public_path(Config::get('api.storage_path').$log->images);

        //Delete image
        File::delete($path);

        //Delete storage entry
        $log->delete();

        //Remove job from queue
        $job->delete();

        return;

    }

}

 ?>