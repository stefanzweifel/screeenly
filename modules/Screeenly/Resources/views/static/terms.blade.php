@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Terms of Service</div>
        <div class="panel-body">
            <p>Last updated: November 11, 2020</p>

            <p>Use of the screeenly.com website and all associated services is offered subject to agreement to the
                following terms of service.</p>

            <h2 class="h3">No Warranty</h2>

            <p>All services are provided &quot;as is&quot; without any warranty of any kind including but not limited to
                fitness for a particular purpose.</p>

            <h2 class="h3">Fair Usage</h2>

            <p>screeenly.com provides a <b>free</b> API to capture screenshots of publicly available websites. Please
                keep this in mind when implementing our API in your application .</p>
            <p><b>DO NOT</b> issue thousands of HTTP requests in a short amount of time. If we detect that your IP
                address is creating too much strain on our servers, we will block your IP address.</p>

            <h2 class="h3">Abuse</h2>

            <p>We reserve the right to take action in response to reported abuse of our services. This action may
                include - but is not limited to - the deletion of API tokens or other account details. Abuse may include
                - but is not limited to - any action which is illegal under the city, state, or federal laws where you
                are currently present. This includes copyright infringement under the DMCA or any activity which we deem
                disruptive.</p>

            <h2 class="h3">Modification of Agreement</h2>

            <p>screeenly reserves the right to modify this agreement at any time without prior notice.</p>
        </div>

    </div>

@stop
