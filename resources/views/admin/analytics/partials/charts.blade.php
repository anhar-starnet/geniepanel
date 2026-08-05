<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Online vs Offline Trend
                </h3>
            </div>

            <div class="card-body">

                <canvas
                    id="onlineChart"
                    height="120">
                </canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    System Status
                </h3>
            </div>

            <div class="card-body">

                <div class="progress-group">
                    Online
                    <span class="float-right">
                        {{ $analytics['summary']['online'] }}
                    </span>

                    <div class="progress">
                        <div
                            class="progress-bar bg-success"
                            style="width:80%">
                        </div>
                    </div>

                </div>

                <div class="progress-group mt-3">
                    Offline

                    <span class="float-right">
                        {{ $analytics['summary']['offline'] }}
                    </span>

                    <div class="progress">

                        <div
                            class="progress-bar bg-danger"
                            style="width:20%">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>