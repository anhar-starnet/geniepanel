<div class="row mb-3">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="card-online">
                    {{ $analytics['summary']['online'] }}
                </h3>
                <p>Online ONU</p>
            </div>

            <div class="icon">
                <i class="fas fa-wifi"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="card-offline">
                    {{ $analytics['summary']['offline'] }}
                </h3>
                <p>Offline ONU</p>
            </div>

            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 id="card-rx">
                    {{ $analytics['summary']['rxCritical'] }}
                </h3>
                <p>RX Critical</p>
            </div>

            <div class="icon">
                <i class="fas fa-signal"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="card-temp">
                    {{ $analytics['summary']['tempCritical'] }}
                </h3>
                <p>Temperature Critical</p>
            </div>

            <div class="icon">
                <i class="fas fa-thermometer-half"></i>
            </div>
        </div>
    </div>

</div>