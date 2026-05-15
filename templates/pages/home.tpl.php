<section class="mb-5">
    <div class="p-4 mb-4 rounded-3" style="background: linear-gradient(135deg, #e63946 0%, #343a40 100%); color: white;">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold">
                <i class="bi bi-sign-stop-fill me-2"></i>Traffic Restriction Portal
            </h1>
            <p class="col-md-9 fs-5">
                Your source for Hungarian road traffic restriction data.
                Browse active restrictions, road closures, and speed limits across Hungary.
            </p>
            <a href="crud" class="btn btn-light btn-lg mt-2">
                <i class="bi bi-table me-1"></i> View All Restrictions
            </a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 text-center p-3">
                <div class="card-body">
                    <i class="bi bi-cone-striped display-4 text-danger"></i>
                    <h5 class="card-title mt-3">Road Restrictions</h5>
                    <p class="card-text text-muted">
                        Detailed records of traffic restrictions including road closures,
                        lane narrowings, and speed limit changes across Hungarian roads.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center p-3">
                <div class="card-body">
                    <i class="bi bi-speedometer2 display-4 text-warning"></i>
                    <h5 class="card-title mt-3">Speed Limits</h5>
                    <p class="card-text text-muted">
                        Up-to-date speed limit information for affected road sections,
                        helping drivers plan their journeys safely.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center p-3">
                <div class="card-body">
                    <i class="bi bi-geo-alt-fill display-4 text-success"></i>
                    <h5 class="card-title mt-3">Settlement Data</h5>
                    <p class="card-text text-muted">
                        Restrictions organized by settlement and road number,
                        covering locations across the entire country.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4"><i class="bi bi-camera-video-fill me-2 text-danger"></i>Videos</h2>
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-film me-1"></i> Road Works – Short Clip
                </div>
                <div class="card-body p-0">
                    <div class="video-wrapper">
                        <video controls muted autoplay loop>
                            <source src="./images/road.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="card-footer text-muted small">
                    Local video clip – road construction footage
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-youtube me-1"></i> Hungarian Road Network – Overview
                </div>
                <div class="card-body p-0">
                    <div class="video-wrapper">
                        <iframe
                            src="https://www.youtube.com/embed/LQSeHlTaPTE?si=5e53zmhbZ1Uz9TT3"
                            title="Hungarian Road Network"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="card-footer text-muted small">
                    YouTube – Hungarian road infrastructure overview
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4"><i class="bi bi-map-fill me-2 text-danger"></i>Location</h2>
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-pin-map-fill me-1"></i> Budapest, Hungary – Magyar Közút Headquarters
        </div>
        <div class="card-body p-2">
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d86055.98836108658!2d18.9959368!3d47.4979937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c334d1d4cfc9%3A0x400c4290c1e1160!2sBudapest%2C+Hungary!5e0!3m2!1sen!2shu!4v1700000000000"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        <div class="card-footer text-muted small">
            Budapest, Hungary – the center of the Hungarian road network management
        </div>
    </div>

    <h2 class="mb-4"><i class="bi bi-bar-chart-fill me-2 text-danger"></i>About the Data</h2>
    <div class="row g-3">
        <div class="col-6 col-md-3">
            <div class="card text-center p-3 bg-danger text-white">
                <h3 class="fw-bold">35+</h3>
                <small>Restriction Records</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center p-3 bg-dark text-white">
                <h3 class="fw-bold">11</h3>
                <small>Restriction Types</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center p-3 bg-warning text-dark">
                <h3 class="fw-bold">6</h3>
                <small>Closure Extents</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center p-3 bg-secondary text-white">
                <h3 class="fw-bold">2010</h3>
                <small>Data Year</small>
            </div>
        </div>
    </div>
</section>