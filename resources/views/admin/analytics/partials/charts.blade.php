<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Online vs Offline Trend
                </h3>
            </div>

            <div class="card-body">

                <div style="height:320px">

    <canvas id="onlineChart"></canvas>

</div>

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
                            style="width:
{{ ($analytics['summary']['online'] /
max(1,
$analytics['summary']['online']
+
$analytics['summary']['offline']))
*100 }}%">
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
                            style="width:
{{ ($analytics['summary']['offline'] /
max(1,
$analytics['summary']['online']
+
$analytics['summary']['offline']))
*100 }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>